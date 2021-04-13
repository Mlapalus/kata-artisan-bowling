<?php

namespace App;

interface RandomInterface
{
  public function setMax(int $index, int $max): void;
  public function set(int $index, int $pin): void;
  public function get(int $index): int;
}