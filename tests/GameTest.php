<?php

namespace App\Tests;

use App\Game;
use App\RandomPin;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
  private Game $game;
  private RandomPin $random;

  public function setUp(): void
  {
    $this->random = new RandomPin();
    $this->game = new Game($this->random);
  }

  public function test_roll_return_a_number_beetwen_0_and_10()
  {
    $this->assertGreaterThanOrEqual(0, $this->game->roll(1));
    $this->assertLessThanOrEqual(10, $this->game->roll(1));
  }

  public function test_roll_return_a_number_beetwen_0_and_10_minus_the_precedent_if_pair()
  {
    $this->random->set(1, 1);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(9, $this->game->roll(2));
    $this->assertLessThanOrEqual(10, $this->game->roll(3));

    $this->random->set(1, 2);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(8, $this->game->roll(2));

    $this->random->set(1, 3);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(7, $this->game->roll(2));

    $this->random->set(1, 4);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(6, $this->game->roll(2));

    $this->random->set(1, 5);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(5, $this->game->roll(2));

    $this->random->set(1, 6);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(4, $this->game->roll(2));

    $this->random->set(1, 7);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(3, $this->game->roll(2));

    $this->random->set(1, 8);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(2, $this->game->roll(2));

    $this->random->set(1, 9);
    $this->game->roll(1);
    $this->assertLessThanOrEqual(1, $this->game->roll(2));
  }

  public function test_score_regular_9()
  {
    $this->random->set(1, 3);
    $this->game->roll(1);
    $this->random->set(2, 6);
    $this->game->roll(2);
    $this->assertEquals(9, $this->game->score());
  }

  public function test_score_regular_0()
  {
    $this->random->set(1, 0);
    $this->game->roll(1);
    $this->random->set(2, 0);
    $this->game->roll(2);
    $this->assertEquals(0, $this->game->score());
  }

  public function test_spear()
  {
    $this->random->set(1, 6);
    $this->game->roll(1);
    $this->assertEquals(6, $this->game->score());

    $this->random->set(2, 4);
    $this->game->roll(2);
    $this->assertEquals(10, $this->game->score());

    $this->random->set(3, 8);
    $this->game->roll(3);
    $this->assertEquals(26, $this->game->score());
  }

  public function test_strike()
  {
    $this->random->set(1, 10);
    $this->game->roll(1);

    $this->random->set(3, 4);
    $this->game->roll(3);

    $this->random->set(4, 5);
    $this->game->roll(4);
    $this->assertEquals(28, $this->game->score());
  }

  public function test_strike_and_spear()
  {
    $this->random->set(1, 10);
    $this->game->roll(1);

    $this->random->set(3, 5);
    $this->game->roll(3);

    $this->random->set(4, 5);
    $this->game->roll(4);

    $this->random->set(5, 8);
    $this->game->roll(5);

    $this->assertEquals(46, $this->game->score());
  }
  public function test_nice()
  {
    $this->random->set(1, 10);
    $this->game->roll(1);

    $this->random->set(3, 10);
    $this->game->roll(3);

    $this->random->set(5, 10);
    $this->game->roll(5);

    $this->random->set(7, 10);
    $this->game->roll(7);

    $this->random->set(9, 10);
    $this->game->roll(9);

    $this->random->set(11, 10);
    $this->game->roll(11);

    $this->random->set(13, 10);
    $this->game->roll(13);

    $this->random->set(15, 10);
    $this->game->roll(15);

    $this->random->set(17, 10);
    $this->game->roll(17);

    $this->random->set(19, 10);
    $this->game->roll(19);

    $this->random->set(21, 10);
    $this->game->roll(21);

    $this->random->set(22, 10);
    $this->game->roll(22);

    $this->assertEquals(300, $this->game->score());
  }
}