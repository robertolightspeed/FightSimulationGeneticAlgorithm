<?php

namespace App\Model\SpecialAbilities;

use App\Model\SpecialAbility;

class MagicShield extends SpecialAbility
{
    public function __construct()
    {
        $this->name = 'Magic Shield';
        $this->percentageToTrigger = 20;
    }

    /**
     * @param int $damageTaken
     * @return int
     */
    public function action($damageTaken)
    {
        return $damageTaken/2;
    }
}