<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\GamificationTypeRepository;
use App\Traits\CrudTrait;
use App\Traits\RedisTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GamificationTypeService
{
    use CrudTrait;
    use RedisTrait;

    protected $gamificationTypeRepository;

    public function __construct(GamificationTypeRepository $gamificationTypeRepository)
    {
        $this->gamificationTypeRepository = $gamificationTypeRepository;
        $this->setActionRepository($gamificationTypeRepository);
    }

    public function getGamificationTypes()
    {
        return $this->gamificationTypeRepository->findAll(
            null,
            null,
            ['column'=> 'display_order', 'direction' => 'asc']
        );
    }

    public function storeGamificationTypes($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $gamificationTypes = $this->gamificationTypeRepository->gamificationTypes();
                $i = 1;
                if (!empty($gamificationTypes)) {
                    $i = $gamificationTypes->display_order + 1;
                }

                $request['display_order'] = $i;
                $this->save($request);
            });

            Helper::removeVersionControlRedisKey();

            return true;

        } catch (\Exception $e) {
            Log::error('Gamification Type store failed' . $e->getMessage());
            return false;
        }
    }

    public function updateGamificationType($data, $id)
    {
        try {
            $gamificationType = $this->findOne($id);
            DB::transaction(function () use ($data, $gamificationType) {
                $gamificationType->update($data);
            });

            Helper::removeVersionControlRedisKey();

            return true;
        } catch (\Exception $e) {
            Log::error('Gamification Type Update failed' . $e->getMessage());
            return false;
        }
    }

    public function deleteGamificationType($id)
    {
        $gamificationType = $this->findOne($id);
        $gamificationType->delete();
        Helper::removeVersionControlRedisKey();
        return Response('Gamification Type has been successfully deleted');
    }

    public function tableSortable($data)
    {
        $this->gamificationTypeRepository->gamificationTypesTableSort($data);
        Helper::removeVersionControlRedisKey();
        return new Response('Sequence has been successfully update');
    }
}
