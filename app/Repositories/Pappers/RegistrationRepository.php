<?php

namespace App\Repositories\Pappers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Helpers\StatusConstant;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class RegistrationRepository
{

  public function __construct(protected Registration $registration)
  {
    // 
  }

  public function query()
  {
    return $this->registration->query();
  }

  public function filter()
  {
    return $this->registration->all()->filter(function ($item) {
      if (Carbon::now()->between($item->date_start, $item->date_end)) {
        return $item;
      }
    })->where('status', StatusConstant::ACTIVE);
  }

  public function index()
  {
    return $this->registration->latest()->get();
  }

  public function store($request)
  {
    return $this->registration->create([
      'code' => Str::random(10),
      'title' => $request->title,
      'date_start' => $request->date_start,
      'date_end' => $request->date_end,
      'status' => $request->status,
    ]);
  }

  public function show($code): Model
  {
    return $this->registration->findOrFail($code);
  }

  public function update($code, $request)
  {
    $registration = $this->show($code);
    return $registration->update([
      'title' => $request->title,
      'date_start' => $request->date_start,
      'date_end' => $request->date_end,
      'status' => $request->status,
    ]);
  }

  public function destroy($code)
  {
    $registration = $this->show($code);
    return $registration->delete();
  }

  public function datatables()
  {
    $query = $this->index();
    $dataTables = DataTables::of($query)->addIndexColumn()
      ->addColumn('title', function ($query) {
        if ($query->title) :
          return $query->title;
        else :
          return '-';
        endif;
      })
      ->addColumn('date_start', function ($query) {
        return customDate($query->date_start, true);
      })
      ->addColumn('date_end', function ($query) {
        return customDate($query->date_end, true);
      })
      ->addColumn('status', function ($query) {
        $status_active = '<span class="badge bg-success">Open</span>';
        $status_inactive = '<span class="badge bg-dark">Closed</span>';

        if ($query->status == StatusConstant::ACTIVE) :
          return $status_active;
        endif;

        if ($query->status == StatusConstant::INACTIVE) :
          return $status_inactive;
        endif;
      })
      ->addColumn('action', function ($query) {
        $edit = '<a href="' . route('registrations.edit', $query->code) . '" class="text-warning me-2"><i class="fa fa-pencil"></i></a>';
        $delete = '<a href="#" onclick="deleteRegistration(`' . route('registrations.destroy', $query->code) . '`)" class="text-danger delete-registrations me-2"><i class="fa fa-trash"></i></a>';
        return $edit . $delete;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $dataTables;
  }
}
