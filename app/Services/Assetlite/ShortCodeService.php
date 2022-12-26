<?php
namespace App\Services\Assetlite;

use App\Repositories\ShortCodeRepository;
use App\Traits\CrudTrait;

class ShortCodeService {
    use CrudTrait;
    protected $shortCodeRepository;

    public function __construct(ShortCodeRepository $shortCodeRepository) {
        $this->shortCodeRepository = $shortCodeRepository;
        $this->setActionRepository($shortCodeRepository);
    }
}
