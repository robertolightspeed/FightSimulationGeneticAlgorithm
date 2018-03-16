<?php

namespace App\Model;

abstract class SpecialAbility
{
    protected $name;

    protected $percentageToTrigger = 0;

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isTrigger()
    {
        return rand(1,100) <= $this->percentageToTrigger;
    }

    /**
     * @param int $damage
     * @return int
     */
    public function action($damage)
    {
        return $damage;
    }
}