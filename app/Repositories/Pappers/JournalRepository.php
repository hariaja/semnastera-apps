<?php

namespace App\Repositories\Pappers;

use App\Models\Journal;
use Illuminate\Support\Str;
use App\Helpers\StatusConstant;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class JournalRepository
{
  public function __construct(protected Journal $journal)
  {
    // 
  }

  public function index()
  {
    if (userRole() == StatusConstant::ADMIN || userRole() == StatusConstant::REVIEWER) :
      return $this->journal->select('*')->orderBy('id', 'ASC');
    else :
      return $this->journal->select('*')
        ->orderBy('id', 'ASC')
        ->where('user_id', userLogin()->id);
    endif;
  }

  public function datatables()
  {
    $query = $this->index();
    return DataTables::of($query)->addIndexColumn()
      ->addColumn('user', function ($row) {
        return $row->user->getUserFullNameLong();
      })
      ->addColumn('action', function ($row) {
        $admin_or_reviewer =
          '<div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              Opsi
            </a>
            <ul class="dropdown-menu mb-0">
              <li class="mb-0">
                <a href="' . route('journals.show', $row->code) . '" class="text-info dropdown-item">Detail</a>
                <a href="#" onclick="deleteJurnal(`' . route('journals.destroy', $row->code) . '`)" class="text-danger dropdown-item">Hapus</a>
              </li>
            </ul>
          </div>';

        $presenter =
          '<div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              Opsi
            </a>
            <ul class="dropdown-menu mb-0">
              <li class="mb-0">
                <a href="' . route('journals.show', $row->code) . '" class="text-info dropdown-item">Detail</a>
              </li>
            </ul>
          </div>';

        if (userRole() == StatusConstant::ADMIN || userRole() == StatusConstant::REVIEWER) :
          return $admin_or_reviewer;
        else :
          return $presenter;
        endif;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
  }

  public function store($request, $file)
  {
    return $this->journal->create([
      'code' => Str::random(20),
      'user_id' => $request->user_id,
      'title' => $request->title,
      'category' => $request->category,
      'abstract' => $request->abstract,
      'upload_year' => $request->upload_year,
      'file' => $file,
      'status' => StatusConstant::PENDING,
    ]);
  }

  public function show($id): Model
  {
    return $this->journal->findOrFail($id);
  }

  public function update($id, $request, $file)
  {
    # code...
  }

  public function destroy($id)
  {
    # code...
  }
}
