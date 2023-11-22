<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class EcareerPortal extends Model
{
    use LogModelAction;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecareer_portals';


   protected $fillable = [
       'title_en', 'title_bn', 'slug', 'description_en', 'description_bn', 'image', 'video',
       'alt_text', 'category', 'route_slug', 'category_type','call_to_action', 'additional_info',
       'page_header', 'page_header_bn', 'schema_markup', 'is_active', 'has_items', 'deleted_at'
   ];


   public function portalItems(){

   	return $this->hasMany(EcareerPortalItem::class, 'ecarrer_portals_id');

   }
}
