<?php
namespace App\Repositories;

/**
 * Interface BaseRepositoryContract
 * @package App\Repositories
 */
interface BaseRepositoryContract
{
    /**
     * Find resource
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findOrFail($id);

    /**
     * Find resource
     *
     * @param $field
     * @param $value
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findBy($field, $value);

    /**
     * @param array $params
     * @param array $fields Which fields to select
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findByProperties(array $params, array $fields = ['*']);

    /**
     * Find resource
     *
     * @param array $params
     * @param array $fields Which fields to select
     * @return Model|null|static
     */
    public function findOneByProperties(array $params, array $fields = ['*']);

    /**
     * Find resource
     *
     * @param $field
     * @param $value
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findOneBy($field, $value);

    /**
     * Find resources by ids
     *
     * @param array $ids
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findByIds($ids);

    /**
     * Retrieve all resources
     *
     * @return \Illuminate\Support\Collection|null|static
     */
    public function getAll();

    /**
     * Save resource
     *
     * @param $resource
     * @return \Illuminate\Support\Collection|null|static
     */
    public function save($resource);

    /**
     * Save resources
     *
     * @param array|Collection $resources
     * @return \Illuminate\Support\Collection|null|static
     */
    public function saveMany($resources);

    /**
     * @param $resource
     * @param $data
     * @return \Illuminate\Support\Collection|null|static
     */
    public function update($resource, $data = []);

    /**
     * Delete resources
     *
     * @param $resource
     * @return \Illuminate\Support\Collection|null|static
     */
    public function delete($resource);


    /**
     * Return model
     *
     * @return Model
     */
    public function getModel();

    /**
     * Creates a new model from properties
     *
     * @param array $properties
     * @return mixed
     */
    public function create(array $properties);
}