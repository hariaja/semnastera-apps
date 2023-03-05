<?php

namespace App\Services\Pappers;

use App\Repositories\Pappers\JournalRepository;

class JournalService
{
  public function __construct(protected JournalRepository $journalRepository)
  {
    // 
  }

  public function index()
  {
    # code...
  }

  public function store($request, $file)
  {
    # code...
  }

  public function show($journal)
  {
    # code...
  }

  public function update($journal, $request, $file)
  {
    # code...
  }

  public function destroy($journal)
  {
    # code...
  }
}
