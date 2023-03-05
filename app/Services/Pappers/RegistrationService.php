<?php

namespace App\Services\Pappers;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Pappers\RegistrationRepository;

class RegistrationService
{

  public function __construct(protected RegistrationRepository $registrationRepository)
  {
    // 
  }

  public function query()
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->query();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function filter()
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->filter();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function index()
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->index();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function store($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->store($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function update($registration, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->update($registration->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function destroy($registration)
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->destroy($registration->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function datatables()
  {
    DB::beginTransaction();
    try {
      $execute = $this->registrationRepository->datatables();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }
}
