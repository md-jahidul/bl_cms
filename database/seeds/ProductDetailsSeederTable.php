<?php

use Illuminate\Database\Seeder;
use App\Models\ProductDetailsSection;

class ProductDetailsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sectionTitleEn = ['Balance Transfer', 'Process', 'Additional Details'];
        $sectionTitleBn = ['ব্যালান্স হস্তান্তর', 'প্রক্রিয়া', 'অতিরিক্ত তথ্য'];

        ProductDetailsSection::create([]);
    }
}
