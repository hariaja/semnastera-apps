<?php

use App\Models\User;
use App\Helpers\StatusConstant;
use App\Models\ActivityLog;

function reviewerCount()
{
  return User::whereHas('roles', function ($data) {
    $data->where('name', StatusConstant::REVIEWER);
  })->count();
}

function presenterCount()
{
  return User::whereHas('roles', function ($data) {
    $data->where('name', StatusConstant::PRESENTER);
  })->count();
}

function participantCount()
{
  return User::whereHas('roles', function ($data) {
    $data->where('name', StatusConstant::PARTICIPANT);
  })->count();
}

function myActivity()
{
  return ActivityLog::with('user')->limit(5)->orderBy('id', 'ASC')->get();
}
