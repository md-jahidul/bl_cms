<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\SliderImage;
use DB;

class SliderImageRepository extends BaseRepository
{
    public $modelName = SliderImage::class;


    public function is_sequence_exist($sequence,$slider_id){
        $image_sequence = DB::table('slider_images')
                    ->where('slider_id',$slider_id)
                    ->where('sequence',$sequence)->get();
        return empty($image_sequence->all());
    }
}
