<?php

namespace App\Services;

use App\Repositories\HealthHubAnalyticRepository;
use App\Repositories\HealthHubRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class HealthHubService
{
    use CrudTrait;
    use FileTrait;

    protected const REDIS_HEALTH_HUB_KEY = "mybl_health_hub_data";

    /**
     * @var HealthHubRepository
     */
    private $healthHubRepository;
    /**
     * @var HealthHubAnalyticRepository
     */
    private $healthHubAnalyticRepository;

    /**
     * HealthHubService constructor.
     * @param HealthHubRepository $healthHubRepository
     */
    public function __construct(
        HealthHubRepository $healthHubRepository,
        HealthHubAnalyticRepository $healthHubAnalyticRepository
    ) {
        $this->healthHubRepository = $healthHubRepository;
        $this->healthHubAnalyticRepository = $healthHubAnalyticRepository;
        $this->setActionRepository($healthHubRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeHealthHub($data)
    {
        $itemCount = $this->findAll()->count();
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('health-hub');
        }

        $data['created_by'] = Auth::user()->id;
        $data['display_order'] = $itemCount + 1;
        $this->save($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Category added successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function updateHealthHub($data, $id)
    {
        $item = $this->healthHubRepository->findOne($id);

        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('manage_image');
            if (!empty($item->icon)) {
                unlink($item->icon);
            }
        }

        $componentTypeURL = isset($data['other_info']['content']);
        if ($componentTypeURL) {
            $url = $data['other_info']['content'];
            if (substr($url, 0, 8) != "https://") {
                $data['other_info']['content'] = "https://" . str_replace(' ', '', $url);
            }
        }

        $data['updated_by'] = Auth::user()->id;
        $item->update($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Health hub update successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function itemTableSort($data): Response
    {
        $this->healthHubRepository->itemTableSort($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Sorted successfully');
    }

    public function analyticReports($request)
    {
        $analyticData = $this->healthHubRepository->getAnalyticData($request);
        $data = $analyticData->map(function ($item) {
            return [
                'id' => $item->id,
                'icon' => $item->icon,
                'title_en' => $item->title_en,
                "total_hit_count" => $item->healthHubAnalytics->sum('hit_count'),
                "total_session_time" => $item->healthHubAnalytics->sum('total_session_time'),
                "total_unique_hit" => $item->healthHubAnalyticsDetails->groupBy('msisdn')->count(),
            ];
        });
        return $data;
    }

    public function itemDetails($request, $itemId)
    {
        return $this->healthHubRepository->getItemDetailsData($request, $itemId);
    }

    public function exportReport($request)
    {
        $reportData = [];
        $itemName = "";
        if ($request->excel_export == "items_export") {
            $reportData = $this->analyticReports($request);
        } elseif ($request->excel_export == "item_export_details") {
            $reportData = $this->healthHubRepository->getItemDetailsData($request, $request->item_id);
            $itemName = $this->healthHubRepository->findOneByProperties(['id' => $request->item_id], ['title_en'])->title_en;
        }
        return $this->generateFileItem($reportData, $request->excel_export, $itemName);
    }

    public function generateFileItem($items, $exportModuleType = null, $itemName = null)
    {
        if ($exportModuleType == "items_export") {
            //Health Hub Items
            $fileName = "items";
            $headerRow = [
                "SL",
                "Item Name",
                "Total Unique Hit",
                "Total Hit Count"
            ];
        } else {
            // Item Details
            $fileName = str_replace(' ', '-', $itemName);
            $headerRow = [
                "SL",
                "Msisdn",
                "Total Hit Count"
            ];
        }

        $headerRowStyle = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(10)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        $writer = WriterEntityFactory::createXLSXWriter();

        $currentDateTime = Carbon::now()->setTimezone('Asia/Dhaka')->toDateTimeString();
        $writer->openToBrowser("health-hub-$fileName-" . str_replace(' ', '-', $currentDateTime) . ".xlsx");
        $row = WriterEntityFactory::createRowFromArray($headerRow, $headerRowStyle);
        $writer->addRow($row);

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();

        foreach ($items as $key => $data) {
            if ($exportModuleType == "items_export") {
                //Health Hub Items
                $report = [
                    'SL' => $key + 1,
                    'title_en' => $data['title_en'],
                    'total_unique_hit' => $data['total_unique_hit'],
                    'total_hit_count' => $data['total_hit_count'],
                ];
            } else {
                // Item Details
                $report = [
                    'SL' => $key + 1,
                    'msisdn' => $data['msisdn'],
                    'hit_count' => $data['hit_count']
                ];
            }
            $row = WriterEntityFactory::createRowFromArray($report, $data_style);
            $writer->addRow($row);
        }
        $writer->close();
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteHealthHubItem($id)
    {
        $item = $this->findOne($id);
        if (!empty($item->icon)) {
            unlink($item->icon);
        }
        $item->delete();
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return [
            'message' => 'Health hub item deleted successfully!!',
        ];
    }
}
