<?php

namespace App\Helpers;

use App\Models\Config;
use Carbon\Carbon;

class ComponentHelper
{

    /**
     * Contextual action list
     * @return array
     */
    public static function components(): array
    {
        // return [
        //      'single_image' => 'Single Image',
        //      'title_text_editor' => 'Title with text editor',
        //      'table_component' => 'Table Component',
        //      'accordion_section' => 'Accordion',
        //      'text_editor' => 'Text Editor',
        //      'box_content' => 'Box Content',
        //      'text_with_image_left_box' => 'Text with image left (Box)',
        //      'text_with_image_left' => 'Text with image left',
        //      'text_with_image_right' => 'Text with image right',
        //      'text_with_image_bottom' => 'Text with image bottom',
        //      'multi_text_with_image_bottom' => 'Multi Text with image bottom',

        //      'top_image_with_desc' => 'Top image with Desc',
        //      'left_image_with_title_desc_btn' => 'Left Image with Title, Desc, btn',
        //      'masonry_1_2_image_layout_col' => 'Masonry 1-2',
        //      'masonry_3_2_image_layout_row' => 'Masonry 3-2',
        //      'multi_col_with_title_desc' => 'Multi Column With title and desc',
        //      'multi_col_with_title_desc_image' => 'Multi Column With title, desc and Image',
        //      'slider_text_with_image_right' => 'Slider text with image right',
        //      'video_with_text_right' => 'Video with text right',
        //      'multiple_image_banner' => 'Multiple image banner',
        //      'pricing_sections' => 'Pricing Multiple table',
        //      'slider_text_with_image_right' => 'Slider text with image right',
        //      'video_with_text_right' => 'Video with text right',
        //      'multiple_image_banner' => 'Multiple image banner',
        //      'pricing_sections' => 'Pricing Multiple table',
        //      'text_with_image_right' => 'Text with image right',
        //      'text_with_image_bottom' => 'Text with image bottom',
        //      'slider_text_with_image_right' => 'Slider text with image right',
        //      'video_with_text_right' => 'Video with text right',
        //      'multiple_image_banner' => 'Multiple image banner',
        //      'pricing_sections' => 'Pricing Multiple table',
        // ];
        return [
                'all' => [
                    'single_image' => 'Single Image',
                    'title_text_editor' => 'Title with text editor',
                    'table_component' => 'Table Component',
                    'accordion_section' => 'Accordion',
                    'text_editor' => 'Text Editor',
                    'box_content' => 'Box Content',
                    'text_with_image_left_box' => 'Text with image left (Box)',
                    'text_with_image_left' => 'Text with image left',
                    'text_with_image_right' => 'Text with image right',
                    'text_with_image_bottom' => 'Text with image bottom',
                    'multi_text_with_image_bottom' => 'Multi Text with image bottom',
        
                    'top_image_with_desc' => 'Top image with Desc',
                    'left_image_with_title_desc_btn' => 'Left Image with Title, Desc, btn',
                    'masonry_1_2_image_layout_col' => 'Masonry 1-2',
                    'masonry_3_2_image_layout_row' => 'Masonry 3-2',
                    'multi_col_with_title_desc' => 'Multi Column With title and desc',
                    'multi_col_with_title_desc_image' => 'Multi Column With title, desc and Image',
                    'top_image_with_caption' => 'Top image with Caption',
                    'top_image_with_title_caption_desc' => 'Top image with Title, Caption and Desc',
                    'right_image_with_title_desc_btn' => 'Right Image with Title, Desc, btn',
                    'multi_col_with_title_desc_icon' => 'Multi Column With title, desc and Icon',
                    'multi_card_with_title_desc_icon' => 'Multi Card With title, desc and Icon',
                    'multi_col_for_video' => 'Multi Column for Video',
                    'multi_col_for_video_middle' => 'Multi Column for Video in middle',
                    'button_component' => 'Button',
                    'multiple_image' => 'Multiple Image',
                    'title_with_video_and_text' => 'Title With Video Text',
                ],
                'blog' => [
                    'single_image' => 'Single Image',
                    'top_image_with_desc' => 'Top image with Desc',
                    'title_text_editor' => 'Title with text editor',
                    'left_image_with_title_desc_btn' => 'Left Image with Title, Desc, btn',
                    'masonry_1_2_image_layout_col' => 'Masonry 1-2',
                    'masonry_3_2_image_layout_row' => 'Masonry 3-2',
                    'multi_col_with_title_desc' => 'Multi Column With title and desc',
                    'multi_col_with_title_desc_image' => 'Multi Column With title, desc and Image'
                ],
        ];
    }
}
