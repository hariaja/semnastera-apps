<?php

namespace App\Helpers\Auto;

class Name
{
  public function sparate($data)
  {
    $this->nama = explode(" ", $data);
    return $this->nama;
  }

  public function firstName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->nama[0]) ? $this->nama[0] : '');
    }
  }

  public function secondName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->nama[1]) ? $this->nama[1] : '');
    }
  }

  public function thirdName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->nama[2]) ? $this->nama[2] : '');
    }
  }

  public function fourthName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->nama[3]) ? $this->nama[3] : '');
    }
  }

  public function countName($data)
  {
    $nama = explode(" ", $data);
    $nama = count($nama);
    return $nama;
  }

  public function nama_pendek($data)
  {
    if (self::countName($data) == 1) {
      $nama = self::firstName($data);
    } elseif (self::countName($data) == 2) {
      $nama = self::firstName($data);
      $nama .= " " . substr(self::secondName($data), 0, 1);
    } elseif (self::countName($data) == 3) {
      $nama = self::firstName($data);
      $nama .= " " . substr(self::secondName($data), 0, 1);
      $nama .= " " . substr(self::thirdName($data), 0, 1);
    } else {
      if (self::countName($data) >= 4) {
        $nama = self::firstName($data);
        $nama .= " " . substr(self::secondName($data), 0, 1);
        $nama .= " " . substr(self::thirdName($data), 0, 1);
        $nama .= " " . substr(self::fourthName($data), 0, 1);
      }
    }
    return $nama;
  }
}
