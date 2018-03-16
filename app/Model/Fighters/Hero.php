<?php

namespace App\Model\Fighters;

use App\Model\Fighter;
use App\Model\SpecialAbilities\Dodge;
use App\Model\SpecialAbilities\MagicShield;
use App\Model\SpecialAbilities\RapidStrike;

class Hero extends Fighter
{
    const ATTR_RANGE = [
        "health" => [70,100],
        "strength" => [70,80],
        "defense" => [45,55],
        "speed" => [40,50],
        "luck" => [10,30],
    ];

    public function __construct($name = "Samerto")
    {
        $this->name     = $name;
        $this->health   = mt_rand(static::ATTR_RANGE['health'][0], static::ATTR_RANGE['health'][1]);
        $this->strength = mt_rand(static::ATTR_RANGE['strength'][0], static::ATTR_RANGE['strength'][1]);
        $this->defense  = mt_rand(static::ATTR_RANGE['defense'][0], static::ATTR_RANGE['defense'][1]);
        $this->speed    = mt_rand(static::ATTR_RANGE['speed'][0], static::ATTR_RANGE['speed'][1]);
        $this->luck     = mt_rand(static::ATTR_RANGE['luck'][0], static::ATTR_RANGE['luck'][1]);

        $this->initialHealth = $this->health;
        //$this->attackAbilities[]  = new RapidStrike();
        $this->defenseAbilities[] = new Dodge($this->getLuck());
        //$this->defenseAbilities[] = new MagicShield();
    }
}