<?php

namespace App\Model\SpecialAbilities;

use App\Model\SpecialAbility;

class Dodge extends SpecialAbility
{
    public function __construct($luck)
    {
        $this->name = 'Dodge';
        $this->percentageToTrigger = $luck;
    }

    /**
     * @param int $damageTaken
     * @return int
     */
    public function action($damageTaken)
    {
        return 0;
    }
}