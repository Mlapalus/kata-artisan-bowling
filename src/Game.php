<?php

namespace App;

class Game
{
  private array $puts;
  private int $nbPutOfBonus;
  private RandomInterface $random;
  private array $put;

  public function __construct(RandomInterface $random)
  {
    $this->put = [
      'pin' => 0,
      'bonus' => 0
    ];

    $this->random = $random;
    $this->puts = [
      $this->put, $this->put, $this->put, $this->put, $this->put,
      $this->put, $this->put, $this->put, $this->put, $this->put, $this->put,
      $this->put, $this->put, $this->put, $this->put, $this->put, $this->put,
      $this->put, $this->put, $this->put, $this->put, $this->put
    ];
    $this->bonus = 0;
    $this->nbPutOfBonus = 0;
  }

  public function roll(int $pins): int
  {
    $index = $pins - 1;
    $this->puts[$index]['pin'] = $this->random->get($pins);
    $this->puts[$index]['bonus'] = $this->calculNbPutsOfBonus($index);
    return $this->puts[$index]['pin'];
  }

  public function calculNbPutsOfBonus(int $index): int
  {
    if (($index % 2 == 0) && ($this->puts[$index]['pin'] == 10)) {
      return 2;
    }
    if (($index % 2 == 1) &&
      ($this->puts[$index]['pin'] + $this->puts[$index - 1]['pin']) == 10 &&
      ($this->nbPutOfBonus == 0)
    ) {
      return 1;
    }
    return $this->nbPutOfBonus;
  }

  public function score(): int
  {
    $result = 0;
    $bonus = 0;
    for ($i = 0; $i < 22; $i++) {
      $result += $this->puts[$i]['pin'];
    }


    for ($i = 0; $i < 18; $i++) {
      if ($this->puts[$i]['bonus'] == 0) {
        $bonus += 0;
      } else {
        if ($this->puts[$i]['bonus'] == 1) {
          $bonus += $this->puts[$i + 1]['pin'];
        }
        if ($this->puts[$i]['bonus'] == 2) {
          $bonus += $this->puts[$i + 2]['pin'] +
            $this->puts[$i + 3 + $this->puts[$i + 2]['bonus'] / 2]['pin'];
        }
      }
    }
    return $result + $bonus;
  }
}