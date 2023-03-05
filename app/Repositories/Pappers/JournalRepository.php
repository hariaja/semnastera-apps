<?php

namespace App\Repositories\Pappers;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Model;

class JournalRepository
{
  public function __construct(protected Journal $journal)
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

  public function show($id): Model
  {
    return $this->journal->findOrFail($id);
  }

  public function update($id, $request, $file)
  {
    # code...
  }

  public function destroy($id)
  {
    # code...
  }
}
