<?php

namespace App\Repositories\Pappers;

use App\Models\Journal;
use App\Models\Revision;
use Illuminate\Support\Str;
use App\Helpers\StatusConstant;
use Yajra\DataTables\Facades\DataTables;

class RevisionRepository
{
  public function __construct(protected Revision $revision)
  {
    // 
  }

  public function index()
  {
    if (userRole() == StatusConstant::ADMIN) :
      return $this->revision->select('*')->orderBy('id', 'ASC');
    endif;

    if (userRole() == StatusConstant::REVIEWER) :
      return $this->revision->select('*')
        ->orderBy('id', 'ASC')
        ->where('revision_by', userLogin()->id);
    endif;
  }

  public function datatables()
  {
    $query = $this->index();
    return DataTables::of($query)->addIndexColumn()
      ->addColumn('user', function ($row) {
        return $row->user->getUserFullNameLong();
      })
      ->addColumn('journal', function ($row) {
        return '<a href="' . route('journals.show', $row->journal->code) . '">Lihat Jurnal</a>';
      })
      ->addColumn('action', function ($row) {
        $admin =
          '<div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              Opsi
            </a>
            <ul class="dropdown-menu mb-0">
              <li class="mb-0">
                <a href="' . route('revisions.show', $row->code) . '" class="text-info dropdown-item">Detail</a>
                <a href="#" onclick="deleteRevision(`' . route('revisions.destroy', $row->code) . '`)" class="text-danger dropdown-item">Hapus</a>
              </li>
            </ul>
          </div>';

        $reviewer =
          '<div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              Opsi
            </a>
            <ul class="dropdown-menu mb-0">
              <li class="mb-0">
                <a href="' . route('revisions.show', $row->code) . '" class="text-info dropdown-item">Detail</a>
              </li>
            </ul>
          </div>';

        if (userLogin()->can('revisions.destroy')) :
          return $admin;
        else :
          return $reviewer;
        endif;
      })
      ->rawColumns(['action', 'journal'])
      ->make(true);
  }

  public function store($request, $file)
  {
    $journal = Journal::findOrFail($request->journal_id);
    $journal->update([
      'status' => $request->status
    ]);

    return $this->revision->create([
      'code' => Str::random(20),
      'journal_id' => $request->journal_id,
      'revision_by' => $request->revision_by,
      'batch' => $request->batch,
      'revision_file' => $file,
    ]);
  }
}
