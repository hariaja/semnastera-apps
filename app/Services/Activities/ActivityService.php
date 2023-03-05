<?php

namespace App\Services\Activities;

use App\Repositories\Activities\ActivityRepository;

class ActivityService
{
  public function __construct(protected ActivityRepository $repository)
  {
    // 
  }

  public function store($model, $caused_by, $log)
  {
    return $this->repository->store($model, $caused_by, $log);
  }
}
