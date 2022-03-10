<?php

namespace App\Services;

use App\Repositories\LoyaltyPartnerImageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Storage;

class LoyaltyPartnerImageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var loyaltyPartnerImageRepository
     */
    private $loyaltyPartnerImageRepository;

    /**
     * @param LoyaltyPartnerImageRepository $loyaltyPartnerImageRepository
     */
    public function __construct(LoyaltyPartnerImageRepository $loyaltyPartnerImageRepository)
    {
        $this->loyaltyPartnerImageRepository = $loyaltyPartnerImageRepository;
        $this->setActionRepository($loyaltyPartnerImageRepository);
    }

    /**
     * @param $data
     * @return array|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Response
     */
    public function storePartnerImage($data)
    {
        try {
            if (!empty($data['banner_img'])) {
                $data['banner_img'] = 'storage/' . $data['banner_img']->store('loyalty-partner');
            }

            if (!empty($data['logo_img'])) {
                $data['logo_img'] = 'storage/' . $data['logo_img']->store('loyalty-partner');
            }

            $data['upload_date'] = Carbon::now()->toDateTimeString();
            $data['uploaded_by'] = auth()->user()->id;

            $this->save($data);

            return Response('Partner image stored successfully !');
        } catch (\Exception $e) {
            return [
                'status' => 'Failed',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $data
     * @param $id
     * @return array|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Response
     */
    public function updatePartnerImage($data, $id)
    {
        try {
            $partnerImage = $this->findOne($id);

            if (!empty($data['banner_img'])) {
                $data['banner_img'] = 'storage/' . $data['banner_img']->store('loyalty-partner');
            }else {
                $data['banner_img'] = '';
            }

            if (!empty($data['logo_img'])) {
                $data['logo_img'] = 'storage/' . $data['logo_img']->store('loyalty-partner');
            }else{
                $data['logo_img'] = '';
            }

            $data['updated_at'] = Carbon::now()->toDateTimeString();
            $partnerImage->update($data);

            return Response('Partner image updated successfully !');
        } catch (\Exception $e) {
            return [
                'status' => 'Failed',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|Response
     * @throws Exception
     */
    public function deletePartnerOffer($id)
    {
        $partnerImage = $this->findOne($id);
//        $this->deleteFile($partnerImage->banner_img);
//        $this->deleteFile($partnerImage->logo_img);
        $partnerImage->delete();

        return Response('Partner image delete successfully');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|Response
     */
    public function getAnalytics($data)
    {
        $response = $this->loyaltyPartnerImageRepository->analytics($data ?? []);

        return Response($response ?? []);
    }

    /**
     * @param $data
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function getReport($data)
    {
        $report = $this->loyaltyPartnerImageRepository->analytics($data);

        if(!is_null($report)){
            $filename = Carbon::now()->timestamp.".csv";
            $filePath = Storage::disk('local')->put($filename, '');
            $writer = WriterEntityFactory::createCSVWriter();
            $writer->openToFile($filePath);

            $cellColumns = [
                WriterEntityFactory::createCell('Banner Image Url'),
                WriterEntityFactory::createCell('Logo Image Url'),
                WriterEntityFactory::createCell('Title'),
                WriterEntityFactory::createCell('Category'),
                WriterEntityFactory::createCell('Status'),
                WriterEntityFactory::createCell('Upload Date')
            ];

            $style = (new StyleBuilder())->setFontBold()->build();

            $headerRow = WriterEntityFactory::createRow($cellColumns,$style);

            $writer->addRow($headerRow);

            $report = $report->items();
            $reportCells = [];
            $host = env('MYBL_API_HOST');

            foreach ($report as $item){
                $row_data = [];
                $row_data[0] = WriterEntityFactory::createCell($host.'/'.$item->banner_img);
                $row_data[1] = WriterEntityFactory::createCell($host.'/'.$item->logo_img);
                $row_data[2] = WriterEntityFactory::createCell($item->title);
                $row_data[3] = WriterEntityFactory::createCell($item->partnerCategory->name_en);
                $row_data[4] = WriterEntityFactory::createCell($item->status ? 'Active' : 'Inactive');
                $row_data[5] = WriterEntityFactory::createCell($item->upload_date);

                $reportCells[] = WriterEntityFactory::createRow($row_data);;
            }

            $writer->addRows($reportCells);

            $writer->close();

            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=export.csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0",
            ];

            return response()->download($filePath, 'export.csv', $headers);
        }else {
            return Response('No data found');
        }
    }


}
