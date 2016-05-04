<?php

namespace App\Capstone;

interface RepositoryInterface
{
    public function all();

    /**
     * find a model by a condition
     *
     * @param string $find
     * @return mixed
     */
    public function find($find);

    /**
     * retrieve a model by id
     *
     * @param integer $id
     * @return mixed
     */
    public function get($id);

    /**
     * create a new model
     *
     * @param array $data
     * @return mixed
     */
    public function create($data);

    /**
     * update a model
     *
     * @param array $data
     * @return mixed
     */
    public function update($data);

    /**
     * delete a model
     *
     * @return mixed
     */
    public function delete();
}