<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\GenericSlider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateVersionCodeGenericSliderTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-version-code-for-generic-slider-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update version code in generic_sliders table.';

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
        $data = [
            'android_version_code_min' => 905001,
            'ios_version_code_min' => 904004,
        ];

        try {
            GenericSlider::where('component_size', '!=', null)->update($data);
            Helper::removeVersionControlRedisKey();

        }catch (\Exception $e) {

            Log::info('update-version-code-for-generic-slider-table command log' . $e->getMessage());
        }
    }
}
