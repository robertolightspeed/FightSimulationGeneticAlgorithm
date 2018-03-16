<?php

namespace App\Model\Fighters;

use App\Model\Fighter;
use App\Model\SpecialAbilities\Dodge;

class Monster extends Fighter
{
    const ATTR_RANGE = [
        "health" => [60,90],
        "strength" => [60,90],
        "defense" => [40,60],
        "speed" => [40,60],
        "luck" => [25,40],
    ];

    public function __construct($name = "Samerto")
    {
        $this->name     = $name;
        $this->health   = mt_rand(static::ATTR_RANGE['health'][0], static::ATTR_RANGE['health'][1]);
        $this->strength = mt_rand(static::ATTR_RANGE['strength'][0], static::ATTR_RANGE['strength'][1]);
        $this->defense  = mt_rand(static::ATTR_RANGE['defense'][0], static::ATTR_RANGE['defense'][1]);
        $this->speed    = mt_rand(static::ATTR_RANGE['speed'][0], static::ATTR_RANGE['speed'][1]);
        $this->luck     = mt_rand(static::ATTR_RANGE['luck'][0], static::ATTR_RANGE['luck'][1]);
        $this->defenseAbilities[] = new Dodge($this->getLuck());
        $this->initialHealth = $this->health;
    }
}