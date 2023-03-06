<?php

namespace App\Repositories\Pappers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Helpers\StatusConstant;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Activities\ActivityRepository;

class TransactionRepository
{

  public function __construct(
    protected Transaction $transaction,
    protected ActivityRepository $activityRepository
  ) {
    # code...
  }

  public function index()
  {
    return $this->transaction->select('*');
  }

  public function self()
  {
    return $this->transaction->where('user_id', userLogin()->id)->select('*');
  }

  public function store($request, $proof)
  {
    $transaction = $this->transaction->create([
      'code' => Str::random(10),
      'user_id' => userLogin()->id,
      'amount' => $request->amount,
      'upload_date' => now()->format('Y-m-d'),
      'proof' => $proof
    ]);
    $this->activityRepository->store($transaction, userLogin()->id, trans('page.create') . ' Transaksi');
    return $transaction;
  }

  public function show($id): Model
  {
    return $this->transaction->findOrFail($id);
  }

  public function update($id, $request, $reason)
  {
    $transaction = $this->show($id);
    $this->activityRepository->store($transaction, userLogin()->id, trans('page.update') . ' Transaksi');
    return $transaction->updateOrFail([
      'status' => $request->status,
      'reason' => $reason
    ]);
  }

  public function destroy($id)
  {
    $transaction = $this->show($id);
    $this->activityRepository->store($transaction, userLogin()->id, trans('page.delete') . ' Transaksi');
    return $transaction->delete();
  }

  public function datatables($request)
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
      ->filter(function ($instance) use ($request) {
        if ($request->status == 'Pending' || $request->status == 'Rejected' || $request->status == 'Approved') :
          $instance->where('status', $request->status);
        endif;

        if (!empty($request->get('search'))) :
          $instance->where(function ($w) use ($request) {
            $search = $request->get('search');
            $w->orWhere('amount', 'LIKE', '%' . $search . '%')
              ->orWhere('upload_date', 'LIKE', '%' . $search . '%');
          });
        endif;
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
