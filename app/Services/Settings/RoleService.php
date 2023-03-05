<?php

namespace App\Services\Settings;

use App\Repositories\Settings\PermissionRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Settings\RoleRepository;

class RoleService
{

  public function __construct(
    protected RoleRepository $roleRepository,
    protected PermissionRepository $permissionRepository
  ) {
    // 
  }

  public function index()
  {
    # code...
  }

  public function show($role)
  {
    # code...
  }

  public function store($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->store($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function update($role, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->update($role->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function destroy($role)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->destroy($role->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function permissionData()
  {
    DB::beginTransaction();
    try {
      $execute = $this->permissionRepository->index();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function roleHasPermission($role)
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->roleHasPermission($role->id);
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
      $execute = $this->roleRepository->datatables();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function whereNotIn()
  {
    DB::beginTransaction();
    try {
      $execute = $this->roleRepository->whereNotIn();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }
}
