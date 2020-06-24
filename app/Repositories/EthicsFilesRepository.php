<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 22/06/2020
 */

namespace App\Repositories;

use App\Models\EthicsFiles;

class EthicsFilesRepository extends BaseRepository {

    public $modelName = EthicsFiles::class;

    public function getFiles() {
        $files = $this->model->orderBy('sort')->get();
        return $files;
    }

    public function saveFileData($filePath, $request) {
        try {

            $file = $this->model;
            if ($request->file_id > 0) {
                $file = $this->model->findOrFail($request->file_id);
            }

            $file->file_name_en = $request->file_name_en;
            $file->file_name_bn = $request->file_name_bn;
            $file->file_path = $filePath;
            $file->status = $request->status;
            $file->save();

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

    public function changeFileSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $fileId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($fileId);
                $update['sort'] = $new_position;
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

    public function changeFileStatus($fileId) {
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

    public function getFileData($fileId) {

        $file = $this->model->findOrFail($fileId);
        return $file;
    }

}
