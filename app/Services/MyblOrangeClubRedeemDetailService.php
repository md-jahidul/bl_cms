<?php

    namespace App\Services;

    use App\Repositories\MyblOrangeClubBannerRepository;
    use App\Repositories\MyblOrangeClubRedeemDetailRepository;
    use App\Traits\CrudTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Response;

    class MyblOrangeClubRedeemDetailService
    {
        use CrudTrait;
        private  $myblOrangeClubRedeemDetailRepository;

        public function __construct(
            MyblOrangeClubRedeemDetailRepository $myblOrangeClubRedeemDetailRepository
        ) {
            $this->myblOrangeClubRedeemDetailRepository = $myblOrangeClubRedeemDetailRepository;
        }

        public function first() {
            return $this->myblOrangeClubRedeemDetailRepository->first();
        }
        public function save(array $data)
        {
            $data['redeem_logo'] = 'storage/' . $data['redeem_logo']->store('orange_club');
            try {
                $this->myblOrangeClubRedeemDetailRepository->save($data);

                return true;
            } catch (\Exception $e){

                return false;
            }
        }


        public function update($id, array $data)
        {
            try {
                $orangeClubDetail = $this->myblOrangeClubRedeemDetailRepository->findOne($id);
                if (!empty($data['redeem_logo'])) {
                    $data['redeem_logo'] = 'storage/' . $data['redeem_logo']->store('orange_club');
                    if (isset($orangeClubDetail) && file_exists($orangeClubDetail->redeem_logo)) {
                        unlink($orangeClubDetail->redeem_logo);
                    }
                }

                return $orangeClubDetail->update($data);
            } catch (\Exception $e) {
                Log::error('Error while update Redeem Detail : ' . $e->getMessage());
                return false;
            }
        }
    }
