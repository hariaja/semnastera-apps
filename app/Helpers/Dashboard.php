<?php

use App\Models\User;
use App\Helpers\StatusConstant;
use App\Models\ActivityLog;
use SebastianBergmann\Type\TrueType;
use Yajra\DataTables\Facades\DataTables;

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
  return ActivityLog::with('user')->where('causer_id', userLogin()->id)->orderBy('id', 'ASC')->get();
}

function activityLogDatatables()
{
  $data = myActivity();
  return DataTables::of($data)->addIndexColumn()
    ->editColumn('created_at', function ($row) {
      return customDate($row->created_at, true);
    })
    ->addColumn('time', function ($row) {
      return $row->created_at->format('H:i:s');
    })
    ->make(true);
}

function helpers()
{
  # code...
}
