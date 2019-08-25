<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Slider;
use \Faker\Generator;


class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sliders = array('Home', 'Offer', 'App & Service', 'Business', 'Loyalty');

        $sentences = array(
            array('A descriptive paragraph is a focused and detail-rich account of a specific topic',
                  'Paragraphs in this style often have a concrete focus',
                  'the sound of a waterfall, the stench of a skunk\'s spray'),
            array('but can also convey something abstract, such as an emotion or a memory',
                  'Some descriptive paragraphs do both.', 'Lesson Eleven: descriptive paragraphs.'),
            array('When you write a descriptive paragraph, you are describing something. When you do this, you must use',
                  'How to Write a Descriptive Paragraph. If you want to immerse a reader in an essay or story, there\'s no better way to do it than with a crisp, vivid descriptive',
                  'Now that you have several different examples of descriptive text, you can try your hand at writing a detailed, descriptive sentence')
        );

        foreach ($sliders as $key => $slider){
            Slider::create([
                'slider_type_id' => rand(1, 4),
                'title' => $slider,
                'description' => $sentences[0][rand(0, 2)] . $sentences[1][rand(0, 2)] .$sentences[2][rand(0, 2)],
                'short_code' => 'slider_'.++$key
            ]);
        }
    }
}
