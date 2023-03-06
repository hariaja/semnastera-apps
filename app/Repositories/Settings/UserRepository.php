<?php

namespace App\Repositories\Settings;

use App\Models\User;
use App\Helpers\StatusConstant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Activities\ActivityRepository;

class UserRepository
{
  public function __construct(
    protected User $user,
    protected ActivityRepository $activityRepository
  ) {
    // 
  }

  public function index()
  {
    return $this->user->orderBy('id', 'ASC')->select('*');
  }

  public function admin()
  {
    return $this->user->whereHas('roles', function ($data) {
      $data->where('name', StatusConstant::ADMIN);
    })->latest()->get();
  }

  public function presenter()
  {
    return $this->user->whereHas('roles', function ($data) {
      $data->where('name', StatusConstant::PRESENTER);
    })->latest()->get();
  }

  public function participant()
  {
    return $this->user->whereHas('roles', function ($data) {
      $data->where('name', StatusConstant::PARTICIPANT);
    })->latest()->get();
  }

  public function reviewer()
  {
    return $this->user->whereHas('roles', function ($data) {
      $data->where('name', StatusConstant::REVIEWER);
    })->latest()->get();
  }

  public function datatables($request)
  {
    // $query = $this->user->select('*');
    $query = $this->index();
    $dataTables = DataTables::of($query)->addIndexColumn()
      ->editColumn('first_name', function ($query) {
        return $query->getUserFullNameLong();
      })
      ->editColumn('roles', function ($query) {
        return $query->roles->implode('name');
      })
      ->editColumn('status', function ($query) {
        return $query->getUserStatus();
      })
      ->filter(function ($instance) use ($request) {
        if ($request->get('status') == '0' || $request->get('status') == '1') :
          $instance->where('status', $request->get('status'));
        endif;

        if (!empty($request->get('search'))) :
          $instance->where(function ($w) use ($request) {
            $search = $request->get('search');
            $w->orWhere('first_name', 'LIKE', '%' . $search . '%')
              ->orWhere('last_name', 'LIKE', '%' . $search . '%')
              ->orWhere('first_title', 'LIKE', '%' . $search . '%')
              ->orWhere('last_title', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%');
          });
        endif;
      })
      ->addColumn('action', function ($query) {
        $only = '<div class="dropdown">
          <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
            Opsi
          </a>
          <ul class="dropdown-menu mb-0">
            <li class="mb-0">
              <a href="' . route('users.show', $query->unique_id) . '" class="text-info dropdown-item">Detail</a>
            </li>
          </ul>
        </div>';

        $except = '<div class="dropdown">
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              Opsi
            </a>
            <ul class="dropdown-menu mb-0">
              <li class="mb-0">
                <a href="' . route('users.edit', $query->unique_id) . '" class="text-warning dropdown-item">Ubah</a>
                <a href="' . route('users.show', $query->unique_id) . '" class="text-info dropdown-item">Detail</a>
                <a href="#" onclick="deleteUser(`' . route('users.destroy', $query->unique_id) . '`)" class="text-danger delete-users dropdown-item">Hapus</a>
              </li>
            </ul>
          </div>';

        if ($query->isRole() == StatusConstant::ADMIN) :
          return $only;
        else :
          return $except;
        endif;
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
    return $dataTables;
  }

  public function show($id): Model
  {
    return $this->user->findOrFail($id);
  }

  public function update($id, $request, $avatar)
  {
    $user = $this->show($id);
    $user->update([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'first_title' => $request->first_title,
      'last_title' => $request->last_title,
      'email' => $request->email,
      'phone' => $request->phone,
      'gender' => $request->gender,
      'institution' => $request->institution,
      'address' => $request->address,
      'status' => $request->status,
      'avatar' => $avatar,
    ]);
    $this->activityRepository->store($user, userLogin()->id, trans('page.update') . ' Pengguna');
    return $user;
  }

  public function destroy($id)
  {
    $user = $this->show($id);
    $user->delete();
    $this->activityRepository->store($user, userLogin()->id, trans('page.delete') . ' Pengguna');
    return $user;
  }

  public function change_password($id, $request)
  {
    $user = $this->show($id);
    $user->update([
      'password' => Hash::make($request->new_password)
    ]);
    $this->activityRepository->store($user, userLogin()->id, trans('page.update') . ' Pengguna');
    return $user;
  }
}
