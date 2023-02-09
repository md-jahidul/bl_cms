<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class EcareerPortalItem extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecareer_portal_items';


    protected $fillable = [
        'ecarrer_portals_id',
        'title_en', 'title_bn',
        'sub_title_en', 'sub_title_bn',
        'description_en', 'description_bn',
        'image', 'video', 'alt_text',
        'alt_links', 'call_to_action',
        'additional_info', 'is_active',
        'deleted_at', 'image_name', 'image_name_bn', 'alt_text_bn','slug'];
}
