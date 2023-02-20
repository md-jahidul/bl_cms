<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CorpInitiativeTabComponent extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'initiative_tab_id',
        'component_type',
        'component_title_en',
        'component_title_bn',
        'title_en',
        'title_bn',
        'editor_en',
        'editor_bn',
        'multiple_attributes',
        'component_order',
        'single_base_image',
        'single_alt_text_en',
        'single_alt_text_bn',
        'single_image_name_en',
        'single_image_name_bn',
        'status',
    ];

    protected $casts = [
        'multiple_attributes' => 'array'
    ];

    public function batchTabs()
    {
        return $this->hasMany(CorpIntBatchComponentTab::class, 'corp_int_tab_com_id', 'id');
    }

    public function multiComponent()
    {
        return $this->hasMany(CorpIntComponentMultiItem::class, 'corp_int_tab_com_id', 'id');
    }
}
