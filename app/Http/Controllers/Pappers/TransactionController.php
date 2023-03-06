<?php

namespace App\Http\Controllers\Pappers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\StatusConstant;
use App\Http\Controllers\Controller;
use App\Services\Pappers\TransactionService;
use App\Services\Pappers\RegistrationService;
use App\Http\Requests\Pappers\TransactionRequest;
use App\Models\Registration;

class TransactionController extends Controller
{

  public function __construct(
    protected TransactionService $service,
    protected RegistrationService $registrationService
  ) {
    // 
  }
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $registration = $this->registrationService->filter();

    if ($request->ajax()) :
      return $this->service->datatables($request);
    endif;

    if (userRole() == StatusConstant::ADMIN) :
      return view('pappers.transactions.index');
    else :
      if ($registration->isNotEmpty()) :
        return view('pappers.transactions.index');
      else :
        return view('errors.submit-close');
      endif;
    endif;
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pappers.transactions.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TransactionRequest $request)
  {
    $this->service->store($request);
    return redirect()->route('transactions.index')->with('success', trans('page.success_store'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    return view('pappers.transactions.show', compact('transaction'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Transaction $transaction)
  {
    $this->service->update($transaction, $request);
    return redirect()->route('transactions.index')->with('success', trans('page.success_update'));
  }
}
