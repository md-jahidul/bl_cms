<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\TagRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class TagService
{
    use CrudTrait;

    /**
     * @var $tagRepository
     */
    protected $tagRepository;

    /**
     * TagService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->setActionRepository($tagRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeTag($data)
    {
        $data['slug'] = str_replace(" ", "_", strtolower($data['title']));
        $this->save($data);
        return new Response('Tag added successfully');
    }

    /**
     * Updating the tag
     * @param $data
     * @return Response
     */
    public function updateTag($data, $id)
    {
        $tag = $this->findOne($id);
        $data['slug'] = str_replace(" ", "_", strtolower($data['title']));
        $tag->update($data);
        return Response('Tag updated successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteTag($id)
    {
        $tag = $this->findOne($id);
        $tag->delete();
        return Response('Slider deleted successfully !');
    }
}
