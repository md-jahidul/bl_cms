<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 1:15 PM
 */

namespace App\Services;

use App\Models\FourGDeviceTag;
use App\Repositories\FourGDevicesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;

class FourGDevicesService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var FourGDevicesService
     */
    private $fourGDevicesService;

    /**
     * FourGDevicesService constructor.
     * @param FourGDevicesRepository $fourGDevicesService
     */
    public function __construct(FourGDevicesRepository $fourGDevicesService)
    {
        $this->fourGDevicesService = $fourGDevicesService;
        $this->setActionRepository($fourGDevicesService);
    }

    /**
     * @param $data
     * @return array
     */
    public function storeDevices($data)
    {
        try {
            $directoryPath = "assetlite/images/four-g-device";
            if (!empty($data['card_logo'])) {
                $data['card_logo'] = $this->upload($data['card_logo'], $directoryPath);
            }
            if (!empty($data['thumbnail_image'])) {
                $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $directoryPath);
            }
            $device = $this->save($data);

            foreach ($data['device_tags'] as $role) {
                $device->deviceTags()->attach(FourGDeviceTag::find($role));
            }

            $response = [
                'success' => 1,
                'message' => 'Devices added successfully'
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

    /**
     * @param $data
     * @param $id
     * @return array
     */
    public function updateDevices($data, $id)
    {
        try {
            $device = $this->findOne($id);
            $directoryPath = "assetlite/images/four-g-device";
            if (!empty($data['card_logo'])) {
                $data['card_logo'] = $this->upload($data['card_logo'], $directoryPath);
                $this->deleteFile($device->card_logo);
            }
            if (!empty($data['thumbnail_image'])) {
                $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $directoryPath);
                $this->deleteFile($device->thumbnail_image);
            }
            $device->update($data);

            foreach ($device->deviceTags as $tag) {
                $device->deviceTags()->detach($tag->id);
            }

            foreach ($data['device_tags'] as $role) {
                $device->deviceTags()->attach(FourGDeviceTag::find($role));
            }

            $response = [
                'success' => 1,
                'message' => 'Devices update successfully'
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function deleteDevices($id)
    {
        try {
            $devices = $this->findOne($id);
            $devices->delete();
            $this->deleteFile($devices->card_logo);
            $this->deleteFile($devices->thumbnail_image);
            $response = [
                'success' => 0,
                'message' => 'Devices deleted successfully'
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }
}
