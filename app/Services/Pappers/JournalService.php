<?php

namespace App\Services\Pappers;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Pappers\JournalRepository;

class JournalService
{
  public function __construct(protected JournalRepository $journalRepository)
  {
    // 
  }

  public function index()
  {
    return $this->journalRepository->datatables();
  }

  public function showDatatables($id)
  {
    return $this->journalRepository->showDatatables($id);
  }

  public function store($request)
  {
    DB::beginTransaction();
    try {
      if ($request->file('file')) :
        $file = Storage::putFile(
          'public/pdf/journals',
          $request->file('file')
        );
      endif;
      $execute = $this->journalRepository->store($request, $file);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
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
