<?php

namespace Onboardr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Repository
{
    /** @var Model $model */
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a new model
     *
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Destroy the models for the given IDs.
     *
     * @param  array|int  $ids
     * @return int
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * Get an find a model
     *
     * @param int $id
     *
     * @return Model
     */
    public function find($id)
    {
        return $this->model->where('id', $id)->get()->first();
    }

    /**
     * Find model by id or throw an exception
     *
     * @param $id
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail($id)
    {
        $model = $this->find($id);

        if( ! $model) {
            throw new ModelNotFoundException(get_class($this) . ' with ID '.$id.' not found.');
        }

        return $model;
    }

    /**
     * Find an entity by a field
     *
     * @param string $field
     * @param mixed $value
     *
     * @return Model
     */
    public function findBy($field, $value)
    {
        return $this->model->where($field, $value)->get()->first();
    }

    /**
     * Find an entity by a field or fail
     *
     * @param string $field
     * @param mixed $value
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findByOrFail($field, $value)
    {
        $model = $this->findBy($field, $value);

        if( ! $model) {
            throw new ModelNotFoundException("$field has no value $value");
        }

        return $model;
    }

    /**
     * Update only entity fields that are present in values array.
     *
     * @param $id
     * @param $values
     * @throws ModelNotFoundException
     * @return Model
     */
    public function update($id, $values)
    {
        if ($entity = $this->model->find($id)) {
            $entity->fill($values)->save();

        } else {
            throw new ModelNotFoundException(get_class($this->model) . ' with ID ' . $id);
        }

        return $entity;
    }

    /**
     * Find by an array of where constraints
     *
     * @param array $constraints
     */
    public function where(array $constraints)
    {
        return $this->model->where($constraints)->get();
    }
}