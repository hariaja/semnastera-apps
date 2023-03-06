<?php

namespace App\Services\Pappers;

use App\Helpers\StatusConstant;
use App\Mail\Transactions\TransactionApproveMail;
use App\Mail\Transactions\TransactionRejectMail;
use App\Mail\Transactions\TransactionSubmitMail;
use App\Models\User;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Pappers\TransactionRepository;
use Illuminate\Support\Facades\Mail;

class TransactionService
{

  public function __construct(protected TransactionRepository $transactionRepository)
  {
    // 
  }

  public function index()
  {
    return $this->transactionRepository->index();
  }

  public function store($request)
  {
    DB::beginTransaction();
    try {
      if ($request->file('proof')) :
        $proof = Storage::putFile('public/images/proof', $request->file('proof'));
      endif;
      $stored = $this->transactionRepository->store($request, $proof);

      $user = User::findOrFail(userLogin()->id);

      $transaction = array();
      $transaction['referensi'] = $stored->code;
      $transaction['name_user'] = $stored->user->first_name . " " . $stored->user->last_name;
      $transaction['amount'] = formatRupiah($stored->amount);
      $transaction['no_rek'] = StatusConstant::NO_REK;
      $transaction['bank_name'] = StatusConstant::BANK_NAME;
      $transaction['bank_user_name'] = StatusConstant::BANK_USER_NAME;
      $transaction['upload_date'] = customDate($stored->upload_date, true);
      $transaction['payment_status'] = StatusConstant::PENDING;
      $transaction['url_details'] = route('transactions.show', $stored->code);

      Mail::to($user->email)->send(new TransactionSubmitMail($transaction));
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to exe data');
    }
    DB::commit();
    return $stored;
  }

  public function update($transaction, $request)
  {
    DB::beginTransaction();
    try {
      if ($request->status != StatusConstant::REJECTED) :
        $reason = null;
      else :
        $reason = $request->reason;
      endif;
      $execute = $this->transactionRepository->update($transaction->id, $request, $reason);

      if ($request->status == StatusConstant::REJECTED) :
        $this->sendEmailRejected($transaction);
      endif;

      if ($request->status == StatusConstant::APPROVED) :
        $this->sendEmailApproved($transaction);
      endif;
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function sendEmailRejected($transaction)
  {
    $userEmail = $transaction->user->email;
    $userName = $transaction->user->first_name . " " . $transaction->user->last_name;
    $data = array();
    $data['name_user'] = $userName;
    $data['url_details'] = route('transactions.show', $transaction->code);
    Mail::to($userEmail)->send(new TransactionRejectMail($data));
  }

  public function sendEmailApproved($transaction)
  {
    $userEmail = $transaction->user->email;
    $userName = $transaction->user->first_name . " " . $transaction->user->last_name;
    $data = array();
    $data['name_user'] = $userName;
    $data['url_details'] = route('transactions.show', $transaction->code);
    Mail::to($userEmail)->send(new TransactionApproveMail($data));
  }

  public function destroy()
  {
    # code...
  }

  public function datatables($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->transactionRepository->datatables($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }
}
