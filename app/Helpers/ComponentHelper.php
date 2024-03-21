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
                'customer_complaint' => 'Customer Complaint',
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
            'explore_c' => [
                'text_with_image_left_box' => 'Text with image left (Box)',
                'text_with_image_left' => 'Text with image left',
                'text_with_image_right' => 'Text with image right',
                'text_with_image_bottom' => 'Text with image bottom',
                'multi_text_with_image_bottom' => 'Multi Text with image bottom',
            ],
            'other_dynamic_page' => [
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
                'customer_complaint' => 'Customer Complaint',
            ],
            'business_package' => [
                'single_image' => 'Single Image',
                'table_component' => 'Table Component',
                'text_editor' => 'Text Editor',
                'title_text_editor' => 'Title with text editor',
                'testimonials_with_title_desc' => 'Testimonials with title and desc',
            ],
            'business_package_details' => [
                'single_image' => 'Single Image',
                'table_component' => 'Table Component',
                'accordion_section' => 'Accordion',
                'text_editor' => 'Text Editor',
                'title_text_editor' => 'Title with text editor',
                'multi_application_form_with_title' => 'Multi Application Forms With Title',
            ]
        ];
    }

    public static function pageComponents(): array
    {
        return [
            'banner_with_button' => 'Banner with Button',
            'hovering_card_component' => 'Hovering Card Component',
            'card_with_bg_color_component' => 'Card with BG color Component',
            'hiring_now_component' => 'Hiring now Component',
            'top_image_card_with_button' => 'Top image card with button',
            'step_cards_with_hovering_effect' => 'Step Cards with hovering effect',
            'galley_masonry' => 'Gallery Masonry',
            'tab_component_with_image_card_one' => 'Tab Component With Image Card One',
            'tab_component_with_image_card_two' => 'Tab Component With Image Card Two',
            'tab_component_with_image_card_three' => 'Tab Component With Image Card Three',
            'tab_component_with_image_card_four' => 'Tab Component With Image Card Four',
            'hero_section' => 'Hero Section',
            'text_component' => 'Text Component',
            'text_with_image' => 'Text with Image',
            'top_image_bottom_text_component' => 'Top Image Bottom Text Component',
            'icon_text_component' => 'Icon Text Component',
            'icon_text_with_bg_component' => 'Icon Text With BG Component',
            'video_full_width_component' => 'Video Full Width Component',
            'video_with_text_container_component' => 'Video With Text Container Component',
            'stories_slider' => 'Stories Slider',
            'explore_services' => 'Explore Services',
            'explore_c' => 'Explore C',
            'super_app' => 'Super App',
            'dashboard' => 'Dashboard (Static Component)',
            'amar_offer' => 'Offer For You (Static Component)',
            'loyalty_offer' => 'Loyalty Offer (Static Component)',
            'store_finder' => 'Store Finder (Static Component)',
            'store_finder_map' => 'Store Finder Map (Static Component)',
            'recycle_directory' => 'Recycle Directory (Static Component)',
            'recycle_content' => 'Recycle Content (Static Component)',
            'digital_world' => 'Digital World',
            'bl_lab' => 'Bl Labs',
            'videos_component' => 'Videos Component',
            'icon_text_with_image' => 'Icon Text With Image',
            'multiple_image' => 'Multiple Image'
        ];
    }
}
