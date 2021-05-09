<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\LmsBenifits;

class LmsBenefitRepository extends BaseRepository
{
    public $modelName = LmsBenifits::class;

    public function getBenefit($slug)
    {
        return $this->model
            ->where('page_type', $slug)
            ->orderBy('display_order')->get();
    }

    public function saveFileData($filePath, $request)
    {
        try {
            $benefit = $this->model;
            if ($request->file_id > 0) {
                $benefit = $this->model->findOrFail($request->file_id);
            }

            $benefit->page_type = $request->page_type;
            $benefit->title_en = $request->title_en;
            $benefit->title_bn = $request->title_bn;
            $benefit->image_url = $filePath;
            $benefit->status = $request->status;
            $benefit->display_order = 1;
            $benefit->save();

            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function changeFileSorting($request)
    {
        try {
            $positions = $request->position;
            foreach ($positions as $position) {
                $fileId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($fileId);
                $update['display_order'] = $new_position;
                $update->update();
            }

            $response = [
                'success' => 1,
                'message' => 'Success',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeFileStatus($fileId)
    {
        try {
            $update = $this->model->findOrFail($fileId);
            $status = 1;
            if ($update->status == 1) {
                $status = 0;
            }
            $update['status'] = $status;
            $update->update();

            $response = [
                'success' => 1,
                'status' => $status,
                'message' => 'Success',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function getFileData($fileId)
    {
        return $this->model->findOrFail($fileId);
    }

    public function deleteFile($fileId)
    {
        $file = $this->model->findOrFail($fileId);
        $file->delete();
    }
}
