<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use App\Models\MyBlSearchContent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

/**
 * Class SyncOffersForSearchContents
 * @package App\Console\Commands
 */
class SyncOffersForSearchContents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:search:offers';

    protected $tags = [
        'data' => [
            'internet','mb','dataoffers','databundles','gb'
        ],
        'voice' => [
            'voice','minutes','voiceoffers','minutesbundles'
        ],
        'sms' => [
            'sms','minutes','smsoffers','smsbundles'
        ],
        'mix' => [
            'mixbundles','combooffers'
        ],
        'gift' => [
            'gifts' ,'giftbundles','giftdatabundles','giftinternetbundles'
        ],
        'scr' => [
            'specialcallrate','ratecutteroffers','callrates'
        ]

    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Search Contents with Offers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas('details')->with('details')->get();

        //dd($products->toArray());

        $data = [];

        $this->info('.......Starting......' . PHP_EOL);

        foreach ($products as $product) {
            if ($product->details) {
                if (isset($this->tags[strtolower($product->details->content_type)])) {
                    $data [] = $this->createSearchContents($product);
                }
            } else {
                $this->info(PHP_EOL . '.......Problem......' . $product->product_code . PHP_EOL);
            }
        }

        $this->info(PHP_EOL . '.......Inserting......' . PHP_EOL);

        DB::transaction(function () use ($data) {
            DB::table('my_bl_search_contents')
                              ->where('navigation_action', 'PURCHASE')->delete();

            MyBlSearchContent::insert($data);
        }, 3);

        $this->info(PHP_EOL . '.......Completed......');
    }

    /**
     * @param  MyBlProduct  $product
     * @return array
     */
    public function createSearchContents(MyBlProduct $product)
    {
        $search_contents = $this->tags[$product->details->content_type];

        array_push($search_contents, $product->details->commercial_name_en);
        if ($product->tag) {
            array_push($search_contents, $product->tag);
        }
        if ($product->offer_section_title) {
            array_push($search_contents, $product->offer_section_title);
        }

        return [
            'display_title'     => $product->details->commercial_name_en,
            'search_content'    => implode(', ', $search_contents),
            'navigation_action' => "PURCHASE",
            'other_contents'    => json_encode(
                [
                    'type'    => 'purchase',
                    'content' => $product->product_code
                ]
            ),
            'connection_type' => $product->details->sim_type == 1 ? 'prepaid' :  'postpaid',
            'created_at'   => Carbon::now()->toDateTimeString(),
            'updated_at'   => Carbon::now()->toDateTimeString(),
        ];
    }
}
