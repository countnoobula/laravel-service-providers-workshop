<?php

namespace App\Repositories\Eloquent;

use App\Contracts\CriteriaInterface;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Contracts\RepositoryInterface;
use App\Repositories\Criteria\Criteria;

abstract class Repository implements RepositoryInterface, CriteriaInterface {
    private $app;
    protected $model;
    protected $criteria;
    protected $skipCriteria = false;

    public function __construct(Container $app, Collection $criteria) {
        $this->app = $app;
        $this->criteria = $criteria;
        $this->resetScope();
        $this->makeModel();
    }

    abstract function model();

    public function all($columns = array('*')) {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    public function paginate($perPage = 15, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->simplePaginate($perPage, $columns);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute="id") {
        $survey = $this->model->where($attribute, '=', $id)->firstOrFail();
        if ($survey->update($data)) {
            return $survey;
        }
    }

    public function delete($id) {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function withCount($query = array()) {
        $this->applyCriteria();
        return $this->model->withCount($query)->get();
    }

    private function makeModel() {
        $model = $this->app->make($this->model());

        if(!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    public function getCriteria() {
        return $this->criteria;
    }

    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    public function applyCriteria() {
        if($this->skipCriteria === true)
            return $this;

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}