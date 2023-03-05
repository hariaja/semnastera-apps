<?php

namespace App\Http\Controllers\Pappers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pappers\RegistrationRequest;
use App\Models\Registration;
use App\Services\Pappers\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

  public function __construct(protected RegistrationService $service)
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
    return view('pappers.registrations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pappers.registrations.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RegistrationRequest $request)
  {
    $this->service->store($request);
    return redirect()->route('registrations.index')->with('success', trans('page.success_store'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Registration $registration)
  {
    return view('pappers.registrations.edit', compact('registration'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Registration $registration)
  {
    // dd($registration);
    $this->service->update($registration, $request);
    return redirect()->route('registrations.index')->with('success', trans('page.success_update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    $this->service->destroy($registration);
    return response()->json([
      'message' => trans('page.success_delete')
    ], 200);
  }
}
