<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\StatusConstant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Settings\UserService;
use App\Http\Requests\Settings\UserRequest;
use App\Http\Requests\Settings\ChangePasswordRequest;

class UserController extends Controller
{
  public function __construct(protected UserService $userService)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) :
      return $this->userService->datatables($request);
    endif;
    return view('settings.users.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    if ($user->id != userLogin()->id) :
      return view('settings.users.detail', compact('user'));
    else :
      return view('settings.users.show', compact('user'));
    endif;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    if ($user->id == Auth::user()->id) :
      return back()->with('error', 'Buka halaman profil untuk mengubah data diri anda');
    endif;
    if ($user->isRole() == StatusConstant::ADMIN) :
      return back()->with('error', 'Tidak dapat mengubah ' . $user->isRole());
    endif;

    return view('settings.users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->userService->update($user, $request);
    if ($user->id == userLogin()->id) :
      return redirect()->route('users.show', userLogin()->unique_id)->with('success', trans('page.success_update'));
    else :
      return redirect()->route('users.index')->with('success', trans('page.success_update'));
    endif;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->destroy($user);
    return response()->json([
      'message' => trans('page.success_delete')
    ]);
  }

  /**
   * Change user password
   */
  public function password(ChangePasswordRequest $request)
  {
    $this->userService->password(userLogin(), $request);
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', trans('page.change_password'));
  }
}
