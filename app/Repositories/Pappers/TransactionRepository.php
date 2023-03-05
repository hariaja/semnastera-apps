<?php

namespace App\Repositories\Pappers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Helpers\StatusConstant;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class TransactionRepository
{

  public function __construct(protected Transaction $transaction)
  {
    // 
  }

  public function index()
  {
    return $this->transaction->latest()->get();
  }

  public function self()
  {
    return $this->transaction->where('user_id', userLogin()->id)->get();
  }

  public function store($request, $proof)
  {
    return $this->transaction->create([
      'code' => Str::random(10),
      'user_id' => userLogin()->id,
      'amount' => $request->amount,
      'upload_date' => now()->format('Y-m-d'),
      'proof' => $proof
    ]);
  }

  public function show($id): Model
  {
    return $this->transaction->findOrFail($id);
  }

  public function update($id, $request, $reason)
  {
    $transaction = $this->show($id);
    return $transaction->updateOrFail([
      'status' => $request->status,
      'reason' => $reason
    ]);
  }

  public function destroy($id)
  {
    $transaction = $this->show($id);
    return $transaction->delete();
  }

  public function datatables()
  {
    if (userRole() == StatusConstant::ADMIN || userRole() == StatusConstant::REVIEWER) :
      $query = $this->index();
    else :
      $query = $this->self();
    endif;

    $dataTables = DataTables::of($query)->addIndexColumn()
      ->addColumn('users', function ($query) {
        return $query->user->first_name . " " . $query->user->last_name;
      })
      ->addColumn('upload_date', function ($query) {
        return customDate($query->upload_date, true);
      })
      ->addColumn('status', function ($query) {
        $pending = '<span class="badge bg-secondary">' . $query->status . '</span>';
        $rejected = '<span class="badge bg-danger">' . $query->status . '</span>';
        $approved = '<span class="badge bg-success">' . $query->status . '</span>';

        if ($query->status == StatusConstant::PENDING) :
          return $pending;
        endif;

        if ($query->status == StatusConstant::REJECTED) :
          return $rejected;
        endif;

        if ($query->status == StatusConstant::APPROVED) :
          return $approved;
        endif;
      })
      ->addColumn('action', function ($query) {
        $show = '<a href="' . route('transactions.show', $query->code) . '" class="text-info me-2"><i class="fa fa-eye"></i></a>';
        return $show;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $dataTables;
  }
}
