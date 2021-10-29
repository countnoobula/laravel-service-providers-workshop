<?php

namespace App\Repositories\Criteria;

use App\Contracts\RepositoryInterface as Repository;

abstract class Criteria {
	public abstract function apply($model, Repository $repository);
}