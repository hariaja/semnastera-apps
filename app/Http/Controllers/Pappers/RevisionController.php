<?php

namespace App\Http\Controllers\Pappers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pappers\RevisionRequest;
use App\Models\Revision;
use App\Services\Pappers\RevisionService;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected RevisionService $revisionService)
  {
    // 
  }
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) :
      return $this->revisionService->index();
    endif;

    return view('revisions.index');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RevisionRequest $request)
  {
    $this->revisionService->save($request);
    return redirect()->route('revisions.index')->with('success', trans('page.success_store'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Revision $revision)
  {
    return view('revisions.show', compact('revision'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Revision $revision)
  {
    //
  }
}
