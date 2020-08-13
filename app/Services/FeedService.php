<?php

namespace App\Services;

use App\Repositories\FeedRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FeedService
{
    use CrudTrait;

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
        $this->setActionRepository($feedRepository);
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

    /**
     * Store feed in the db.
     *
     * @param array $data
     * @return Response
     */
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

    /**
     * Update feed in the db
     *
     * @param array $data
     * @param $id
     * @return Response
     */
    public function feedUpdate(array $data, $id)
    {
        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('image_url');
        }

        if (isset($data['file'])) {
            $data['file'] = 'storage/' . $data['file']->store('file');
        }

        $feed = $this->feedRepository->findOne($id);
        $this->feedRepository->update($feed, $data);
        return new Response("Feed has been successfully updated");
    }

    /**
     * Delete feed in the db
     *
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->delete($id);
        return new Response("Feed has been successfully deleted");
    }
}
