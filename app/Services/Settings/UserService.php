<?php

namespace App\Services\Settings;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Settings\UserRepository;

class UserService
{
  public function __construct(
    protected UserRepository $userRepository
  ) {
    // 
  }

  public function datatables($request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->userRepository->datatables($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function presenter()
  {
    return $this->userRepository->presenter();
  }

  public function show($id)
  {
    return $this->userRepository->show($id);
  }

  public function update($user, $request)
  {
    DB::beginTransaction();
    try {
      if ($request->file('avatar')) :
        if ($request->oldImage) :
          Storage::delete($user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/users', $request->file('avatar'));
      else :
        $avatar = $user->avatar;
      endif;
      $execute = $this->userRepository->update($user->id, $request, $avatar);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function destroy($user)
  {
    DB::beginTransaction();
    try {
      if ($user->avatar) :
        Storage::delete($user->avatar);
      endif;
      $execute = $this->userRepository->destroy($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }

  public function password($user, $request)
  {
    DB::beginTransaction();
    try {
      $execute = $this->userRepository->change_password($user->id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }
}
