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

    public function itemsReportExport($request)
    {
        $reportData = $this->analyticReports($request);
        return $this->generateFile($reportData);
    }



    public function generateFile($items, $exportType = null)
    {
        $headerRow = [
            "Item Name",
            "Total Hit Count",
            "Total Session Time",
            "Total Unique Hit"
        ];

        $headerRowStyle = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(10)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        if ($exportType == "csv") {
            $writer = WriterEntityFactory::createCSVWriter();
        } else {
            $writer = WriterEntityFactory::createXLSXWriter();
        }

        $currentDateTime = Carbon::now()->setTimezone('Asia/Dhaka')->toDateTimeString();
        $writer->openToBrowser("Guest-User-Activities-" . str_replace(' ', '-', $currentDateTime) . ".$exportType");
        $row = WriterEntityFactory::createRowFromArray($headerRow, $headerRowStyle);
        $writer->addRow($row);

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();

        foreach ($items as $data) {
            $report = [
                'title_en' => $data['msisdn'],
                'total_hit_count' => $data['device_id'],
                'total_session_time' => $data['total_unique_hit'],
                'total_unique_hit' => $data['total_unique_hit'],
            ];
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
