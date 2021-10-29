<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class UserRepository extends Repository {

	public function model() {
		return \App\Models\User::class;
	}

	public function doesEmailExist($email)
	{
		return $this->model->where('email', '=', $email)->count() > 0;
	}
}