<?php

namespace App\Services;

use App\Repositories\DeeplinkMsisdnHitCountRepository;
use App\Repositories\FeedCategoryRepository;
use App\Repositories\HealthHubAnalyticRepository;
use App\Repositories\HealthHubRepository;
use App\Repositories\MyblDynamicDeeplinkRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use http\Env\Request;
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
     * @var DeeplinkMsisdnHitCountRepository
     */
    private $deeplinkMsisdnHitCountRepository;
    /**
     * @var FeedCategoryRepository
     */
    private $feedCategoryRepository;

    /**
     * HealthHubService constructor.
     * @param HealthHubRepository $healthHubRepository
     */
    public function __construct(
        HealthHubRepository $healthHubRepository,
        HealthHubAnalyticRepository $healthHubAnalyticRepository,
        FeedCategoryRepository $feedCategoryRepository,
        DeeplinkMsisdnHitCountRepository $deeplinkMsisdnHitCountRepository
    ) {
        $this->healthHubRepository = $healthHubRepository;
        $this->healthHubAnalyticRepository = $healthHubAnalyticRepository;
        $this->feedCategoryRepository = $feedCategoryRepository;
        $this->deeplinkMsisdnHitCountRepository = $deeplinkMsisdnHitCountRepository;
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
        return $analyticData->map(function ($item) {
            $totalSessionSeconds = $item->healthHubAnalytics->sum('total_session_time');
            return [
                'id' => $item->id,
                'icon' => $item->icon,
                'title_en' => $item->title_en,
                "total_hit_count" => $item->healthHubAnalytics->sum('hit_count'),
                "total_session_time" => ($totalSessionSeconds != 0) ? $totalSessionSeconds : '',
                "total_unique_hit" => $item->healthHubAnalyticsDetails->groupBy('msisdn')->count(),
            ];
        });
    }

    public function itemDetails($request, $itemId)
    {
        $msisdns = $this->healthHubRepository->getItemDetailsData($request, $itemId);

        $msisdns['data'] = collect($msisdns['data'])->map(function ($data) {
            $data['avg_session_count'] = (int) round($data['avg_session_count']);
            return $data;
        });
        return $msisdns;
    }

    public function exportReport($request)
    {
        $reportData = [];
        $itemName = "";
        if ($request->excel_export == "items_export") {
            $reportData = $this->analyticReports($request);
        } elseif ($request->excel_export == "feed_cat_export") {
            $itemName = "in-app-hit-count";
            $reportData = $this->categoryInAppHitCount($request);
        } elseif ($request->excel_export == "item_export_details") {
            $reportData = $this->healthHubRepository->getItemDetailsData($request, $request->item_id);
            $itemName = $this->healthHubRepository->findOneByProperties(['id' => $request->item_id], ['title_en'])->title_en;
        }
        return $this->generateFileItem($reportData, $request->excel_export, $itemName);
    }

    public function generateFileItem($items, $exportModuleType = null, $itemName = null)
    {
//        dd($exportModuleType);
        if ($exportModuleType == "items_export" || $exportModuleType == "deeplink_items_export" || $exportModuleType == "feed_cat_export") {
            //Health Hub Items
            $fileName = $itemName;
            $headerRow = [
                "SL",
                "Item Name",
                "Total Unique Hit",
                "Total Hit Count"
            ];
            if ($exportModuleType == "items_export") {
                $fileName = "items";
                $headerRow[] = "Total Session Time (Sec)";
            }
        } else {
            // Item Details
            $fileName = str_replace(' ', '-', $itemName);
            $headerRow = [
                "Msisdn",
                "Total Hit Count"
            ];
            if ($exportModuleType != "deeplink_item_export_details" && $exportModuleType != "feed_cat_details_export") {
                $headerRow[] = "Average Session Time (Sec)";
            }
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

        if ($exportModuleType == "deeplink_items_export" || $exportModuleType == "feed_cat_export") {
            //Health Hub Deeplink Info
            $report = [
                'SL' => 1,
                'title_en' => $items['title_en'],
                'total_unique_hit' => $items['total_unique_hit'],
                'total_hit_count' => $items['total_hit_count']
            ];
            $row = WriterEntityFactory::createRowFromArray($report, $data_style);
            $writer->addRow($row);
        } else {
            foreach ($items as $key => $data) {
                if ($exportModuleType == "items_export") {
                    //Health Hub Items
                    $report = [
                        'SL' => $key + 1,
                        'title_en' => $data['title_en'],
                        'total_unique_hit' => $data['total_unique_hit'],
                        'total_hit_count' => $data['total_hit_count'],
                        'total_session_time' => $data['total_session_time'],
                    ];
                } else {
                    // Item Details
                    $report = [
                        'msisdn' => "0" . $data['msisdn'],
                        'hit_count' => $data['hit_count']
                    ];
                    if ($exportModuleType != "deeplink_item_export_details" && $exportModuleType != "feed_cat_details_export") {
                        $report['avg_session_count'] = (int)round($data['avg_session_count']);
                    }
                }
                $row = WriterEntityFactory::createRowFromArray($report, $data_style);
                $writer->addRow($row);
            }
        }
        $writer->close();
    }

    public function deeplinkAnalyticData($request)
    {
        $feedCatData = $this->feedCategoryRepository->getFeedCatWithDeeplinkInfo($request, 'health-hub');
        $data = [
            "id" => $feedCatData->dynamicLinks->id ?? 0,
            'title_en' => "Health Hub",
            "total_hit_count" => isset($feedCatData->dynamicLinks) ? $feedCatData->dynamicLinks->deeplinkMsisdnHitCounts->count(
            ) : 0,
            "total_unique_hit" => isset($feedCatData->dynamicLinks) ? $feedCatData->dynamicLinks->deeplinkMsisdnHitCounts->groupBy(
                'msisdn'
            )->count() : 0,
        ];

        if (isset($request->excel_export) && $request->excel_export == "deeplink_items_export") {
            return $this->generateFileItem($data, $request->excel_export, 'deeplink-analytic-export');
        } elseif (isset($request->excel_export) && $request->excel_export == "deeplink_item_export_details") {
            $itemDetails = $this->deeplinkAnalyticDetails($request, $request->item_id);
            return $this->generateFileItem($itemDetails, $request->excel_export, 'deeplink-analytic-details-export');
        } else {
            return $data;
        }
    }

    public function deeplinkAnalyticDetails($request, $dynamicDeepLinkId)
    {
        return $this->deeplinkMsisdnHitCountRepository->deeplinkAnalyticMsisdnCount($request, $dynamicDeepLinkId);
    }

    public function feedCatDetails($request, $feedCatId)
    {
        return $this->feedCategoryRepository->feedCatHitMsisdnCount($request, $feedCatId);
    }

    public function categoryInAppHitCount($request)
    {
        $feedCatData = $this->feedCategoryRepository->hitCountByfeedCatId($request, 'health-hub');
        $data = [
            "id" => $feedCatData->id ?? 0,
            "title_en" => "Health Hub",
            "total_hit_count" => isset($feedCatData->categoryInAppHitCounts) ? $feedCatData->categoryInAppHitCounts->count(
            ) : 0,
            "total_unique_hit" => isset($feedCatData->categoryInAppHitCounts) ? $feedCatData->categoryInAppHitCounts->groupBy(
                'msisdn'
            )->count() : 0,
        ];
        if (!empty($request->excel_export) && $request->excel_export == "feed_cat_details_export") {
            $feedCatDetails = $this->feedCategoryRepository->feedCatHitMsisdnCount($request, $request['item_id']);
            return $this->generateFileItem($feedCatDetails, $request->excel_export, 'in-app-hit-count-msisdn');
        } else {
            return $data;
        }
        return $data;
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
