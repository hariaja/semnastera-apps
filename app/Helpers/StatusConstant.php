<?php

namespace App\Helpers;

class StatusConstant
{
  const ACTIVE = 1;
  const INACTIVE = 0;

  const MALE = 'Laki - Laki';
  const FEMALE = 'Perempuan';

  const PENDING = 'Pending';
  const APPROVED = 'Approved';
  const REJECTED = 'Rejected';

  // USER ROLE
  const ADMIN = 'Administrator';
  const PRESENTER = 'Pemakalah';
  const PARTICIPANT = 'Peserta';
  const REVIEWER = "Reviewer";

  const NO_REK = "5410401330";
  const BANK_NAME = "BANK CENTRAL ASIA";
  const BANK_USER_NAME = "ADMIN SEMNASTERA";

  const ON_REVIEW = "On Review";
  const ON_REVISION = "On Revision";
  const FINAL = "Final";
}
