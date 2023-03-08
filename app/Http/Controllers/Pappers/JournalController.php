<?php

namespace App\Http\Controllers\Pappers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pappers\JournalRequest;
use App\Models\Journal;
use App\Services\Pappers\JournalService;
use App\Services\Settings\UserService;
use Illuminate\Http\Request;

class JournalController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected JournalService $journalService,
    protected UserService $userService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) :
      return $this->journalService->index();
    endif;

    return view('pappers.journals.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $users = $this->userService->presenter();
    return view('pappers.journals.create', compact('users'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(JournalRequest $request)
  {
    $this->journalService->store($request);
    return redirect()->route('journals.index')->with('success', trans('page.success_store'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Journal $journal, Request $request)
  {
    if ($request->ajax()) :
      return $this->journalService->showDatatables($journal->id);
    endif;
    return view('pappers.journals.show', compact('journal'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Journal $journal)
  {
    //
  }
}
