<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id, $attribute="id");

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($attribute, $value, $columns = array('*'));

    public function withCount($query = array());
}