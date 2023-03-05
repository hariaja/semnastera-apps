<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\RoleRequest;
use App\Models\Role;
use App\Services\Settings\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{

  public function __construct(protected RoleService $service)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) :
      return $this->service->datatables();
    endif;
    return view('settings.roles.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $permissions = $this->service->permissionData();
    return view('settings.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoleRequest $request)
  {
    $this->service->store($request);
    return redirect()->route('roles.index')->with('success', trans('page.success_store'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    if ($role->name == 'Administrator') :
      return redirect()->route('roles.index')->with('error', "Maaf anda tidak bisa MENGUBAH Peran dengan nama $role->name");
    endif;

    $rolePermissions = $this->service->roleHasPermission($role);
    $permissions = $this->service->permissionData();
    return view('settings.roles.edit', compact('role', 'rolePermissions', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoleRequest $request, Role $role)
  {
    $this->service->update($role, $request);
    return redirect()->route('roles.index')->with('success', trans('page.success_update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    if ($role->name == 'Administrator') :
      return response()->json([
        'message' => 'Anda tidak bisa MENGHAPUS peran dengan nama ' . $role->name
      ], 400);
    endif;

    $this->service->destroy($role);
    return response()->json([
      'message' => trans('page.success_delete')
    ], 200);
  }
}
