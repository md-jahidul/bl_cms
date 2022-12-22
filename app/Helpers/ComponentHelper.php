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
            'single_image' => 'Single Image',
            'title_text_editor' => 'Title with text editor',
            'table_component' => 'Table Component',
            'accordion_section' => 'Accordion',
            'text_editor' => 'Text Editor',
            'box_content' => 'Box Content',
//            'text_with_image_right' => 'Text with image right',
//            'text_with_image_bottom' => 'Text with image bottom',
//            'slider_text_with_image_right' => 'Slider text with image right',
//            'video_with_text_right' => 'Video with text right',
///            'multiple_image_banner' => 'Multiple image banner',
//            'pricing_sections' => 'Pricing Multiple table',
        ];
    }
}
