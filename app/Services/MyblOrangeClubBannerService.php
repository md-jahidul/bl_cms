<?php

    namespace App\Services;

    use App\Repositories\MyblOrangeClubBannerRepository;
    use App\Traits\CrudTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Log;

    class MyblOrangeClubBannerService
    {
        use CrudTrait;
        private $myblOrangeClubBannerRepository;

        public function __construct(MyblOrangeClubBannerRepository $myblOrangeClubBannerRepository)
        {
            $this->myblOrangeClubBannerRepository = $myblOrangeClubBannerRepository;
            $this->setActionRepository($myblOrangeClubBannerRepository);
        }

        public function save(array $data)
        {
            $data['display_order'] = $this->findAll()->count() + 1;
            $data['image_url'] = 'storage/' . $data['image_url']->store('orange_club');

            if (isset($data['other_attributes'])) {
                if ($data['component_identifier'] == "FEED_CATEGORY") {
                    $other_attributes = $data['other_attributes'];
                } else {
                    $other_attributes = [
                        'type' => strtolower($data['component_identifier']),
                        'content' => $data['other_attributes']
                    ];
                }
                $data['other_attributes'] = json_encode($other_attributes, true);
            }

            try {
                $this->myblOrangeClubBannerRepository->save($data);

                return true;
            } catch (\Exception $e){

                return false;
            }
        }

        public function findOne($id, $relation = null)
        {
            return $this->myblOrangeClubBannerRepository->findOne($id);
        }

        public function update($id, array $data)
        {
            try {
                $orangeClubImage = $this->myblOrangeClubBannerRepository->findOne($id);
                if (!empty($data['image_url'])) {
                    $data['image_url'] = 'storage/' . $data['image_url']->store('orange_club');
                    if (isset($orangeClubImage) && file_exists($orangeClubImage->image_url)) {
                        unlink($orangeClubImage->image_url);
                    }
                }
                if (isset($data['other_attributes'])) {
                    if ($data['component_identifier'] == "FEED_CATEGORY") {
                        $other_attributes = $data['other_attributes'];
                    } else {
                        $other_attributes = [
                            'type' => strtolower($data['component_identifier']),
                            'content' => $data['other_attributes']
                        ];
                    }
                    $data['other_attributes'] = json_encode($other_attributes);
                }

                return $orangeClubImage->update($data);
            } catch (\Exception $e) {

                Log::error('Error while update section : ' . $e->getMessage());
                return false;
            }
        }

        public function updateOrdering($request)
        {
            $this->myblOrangeClubBannerRepository->updateOrderingPosition($request);
            return new Response('Ordering has been successfully update');
        }
    }
