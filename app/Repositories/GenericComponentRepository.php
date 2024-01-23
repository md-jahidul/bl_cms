<?php
namespace App\Repositories;

use App\Models\GenericComponent;

class GenericComponentRepository extends BaseRepository
{
    public $modelName = GenericComponent::class;

    public function destroy($id)
    {
        return $this->modelName::where('id',$id)->delete();
    }
}
