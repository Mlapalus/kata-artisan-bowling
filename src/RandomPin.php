<?php

namespace App;

class RandomPin implements RandomInterface
{

  private int $pin;
  private array $puts;
  private bool $isForced;

  public function __construct()
  {
    $this->isForced = false;
    $this->puts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  }

  public function setMax(int $index, int $max): void
  {
    $result = rand(0, $max);
    $this->puts[$index - 1] = $result;
  }

  public function get(int $index): int
  {
    if ($this->isForced) {
      $this->isForced = false;
      return $this->puts[$index - 1];
    } else {
      if (($index % 2) == 0) {
        $this->setMax($index, 10 - $this->puts[$index - 2]);
      } else {
        $this->setMax($index, 10);
      }
      return $this->puts[$index - 1];
    }
  }

  public function set(int $index, int $pin): void
  {
    $this->puts[$index - 1] = $pin;
    $this->isForced = true;
  }
}