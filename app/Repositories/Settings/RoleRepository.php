<?php

namespace App\Repositories\Settings;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class RoleRepository
{
  protected $role;

  public function __construct(Role $role)
  {
    $this->role = $role;
  }

  public function index()
  {
    return $this->role->orderBy('name', 'ASC')->get();
  }

  public function show($id): Model
  {
    return $this->role->findOrFail($id);
  }

  public function store($request)
  {
    return $this->role->create([
      'name' => $request->name
    ])->syncPermissions($request->permission);
  }

  public function update($id, $request)
  {
    $data = $this->show($id);
    $data->updateOrFail([
      'name' => $request->name
    ]);
    $data->syncPermissions($request->permission);
    return $data;
  }

  public function destroy($id)
  {
    $delete = $this->show($id);
    $delete->delete();
    return $delete;
  }

  public function roleHasPermission($id)
  {
    $role = $this->show($id);
    return $role->permissions->pluck('name')->toArray();
  }

  public function datatables()
  {
    $query = $this->index();
    $dataTables = DataTables::of($query)->addIndexColumn()
      ->addColumn('user_count', function ($query) {
        return $query->users->count();
      })
      ->addColumn('permission_count', function ($query) {
        if ($query->name == 'Administrator') :
          return 'Memilik Semua Hak Akses';
        else :
          return $query->permissions->count();
        endif;
      })
      ->addColumn('action', function ($query) {
        $edit = '<a href="' . route('roles.edit', $query->id) . '" class="text-warning me-2"><i class="fa fa-pencil"></i></a>';
        $delete = '<a href="#" onclick="deleteRole(`' . route('roles.destroy', $query->id) . '`)" class="text-danger delete-roles me-2"><i class="fa fa-trash"></i></a>';
        return $edit . $delete;
      })
      ->rawColumns(['action'])
      ->make(true);
    return $dataTables;
  }

  public function whereNotIn()
  {
    $query = $this->role->query();
    $result = $query->select('*')->whereNotIn('name', [
      'Administrator'
    ])->orderBy('name', 'asc')->get();
    return $result;
  }
}
