<?php

namespace App\Repositories\Activities;

class ActivityRepository
{
  public function store($model, $causedBy, $log = null)
  {
    activity()->performedOn($model)->causedBy($causedBy)->withProperties(['data' => $model])->log($log);
  }
}
