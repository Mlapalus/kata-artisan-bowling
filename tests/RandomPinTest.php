<?php

namespace App\Tests;

use App\RandomPin;
use PHPUnit\Framework\TestCase;

class RandomPinTest extends TestCase
{
  private RandomPin $random;

  public function setUp(): void
  {
    $this->random = new RandomPin();
  }

  public function test_randomPin_set_function()
  {
    $this->random->set(1, 6);
    $this->assertEquals(6, $this->random->get(1));
  }
}