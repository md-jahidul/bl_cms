<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use App\Models\ProductCore;
use Illuminate\Console\Command;

class SyncMyBlProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl:sync_products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Mybl Products.Insert where show_in_app is true';

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
        // search products from core products
        $products = ProductCore::where('show_in_app', 1)->get();

        $total_products = count($products);
        if (!$total_products) {
            $this->info('No Products found');
            return;
        }
        $bar = $this->output->createProgressBar($total_products);
        $bar->start();

        foreach ($products as $product) {
            MyBlProduct::updateOrCreate(
                [
                    'product_code' => $product->product_code
                ],
                [
                    'status' => 1
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->info('Products Inserted');
    }
}
