<?php

namespace App\Model\SpecialAbilities;

use App\Model\SpecialAbility;

class RapidStrike extends SpecialAbility
{
    public function __construct()
    {
        $this->name = 'Rapid Strike';
        $this->percentageToTrigger = 10;
    }

    /**
     * @param int $damage
     * @return int
     */
    public function action($damage)
    {
        return $damage*2;
    }
}