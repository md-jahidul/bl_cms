<?php

namespace App\Services;

use App\Repositories\FeedRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FeedService
{
    /**
     * @var FeedRepository
     */
    protected $feedRepository;

    /**
     * FeedService constructor.
     * @param FeedRepository $feedRepository
     */
    public function __construct(FeedRepository $feedRepository)
    {
        $this->feedRepository = $feedRepository;
    }

    /**
     * Get all feeds
     *
     * @return FeedRepository|Collection|null
     */
    public function getAll()
    {
        return $this->feedRepository->getAll();
    }

    public function store(array $data)
    {
        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('image_url');
        }

        if (isset($data['file'])) {
            $data['file'] = 'storage/' . $data['file']->store('file');
        }

        $this->feedRepository->save($data);
        return new Response("Feed has been successfully created");
    }
}
