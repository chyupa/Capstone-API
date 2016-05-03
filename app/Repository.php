<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * get all models
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * retrieve a model
     *
     * @param string $find
     * @return mixed
     */
    public function find($find)
    {
        return $this->model->where($find)->get();
    }

    /**
     * get a model by id
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->model->find($id);
    }

    /**
     * create a new model
     *
     * @param array $data
     * @return bool
     */
    public function create($data)
    {
        return $this->model->save($data);
    }

    /**
     * update a model
     *
     * @param array $data
     * @return bool|int
     */
    public function update($data)
    {
        return $this->model->update($data);
    }

    /**
     * destroy a model
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        return $this->model->delete();
    }

}