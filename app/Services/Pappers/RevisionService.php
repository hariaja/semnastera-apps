<?php

namespace App\Services\Pappers;

use App\Helpers\StatusConstant;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Pappers\RevisionRepository;

class RevisionService
{
  public function __construct(protected RevisionRepository $revisionRepository)
  {
    // 
  }

  public function index()
  {
    return $this->revisionRepository->datatables();
  }

  public function save($request)
  {
    DB::beginTransaction();
    try {
      if ($request->status == StatusConstant::ON_REVIEW) :
        $path = 'public/pdf/revisions';
      else :
        $path = 'public/pdf/revisions/final';
      endif;
      if ($request->file('revision_file')) :
        $file = Storage::putFile(
          $path,
          $request->file('revision_file')
        );
      endif;
      $execute = $this->revisionRepository->store($request, $file);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException('Unable to executed action');
    }
    DB::commit();
    return $execute;
  }
}
