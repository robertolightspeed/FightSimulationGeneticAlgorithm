<?php

namespace App\Model\Fighters;

use App\Model\Fighter;
use App\Model\SpecialAbilities\Dodge;
use App\Model\SpecialAbilities\MagicShield;
use App\Model\SpecialAbilities\RapidStrike;

class HeroChild extends Fighter
{
    const ATTR_RANGE = [
        "health" => [70,100],
        "strength" => [70,100],
        "defense" => [45,100],
        "speed" => [40,100],
        "luck" => [10,60],
    ];

    public function __construct(Fighter $hero1, Fighter $hero2)
    {
        $this->name = hero_name() . ' ' . $this->getFamilyName($hero1->getName(), $hero2->getName());
       foreach (static::ATTR_RANGE as $skill => $range)
       {

           $getMethod = 'Get' . ucfirst($skill == 'health'? 'initialHealth' : $skill);
           $this->$skill = $hero1->$getMethod() >= $hero2->$getMethod() ? $hero1->$getMethod() : $hero2->$getMethod();
       }
        $this->defenseAbilities[] = new Dodge($this->getLuck());
        $this->initialHealth = $this->health;
    }

    private function getFamilyName($name1, $name2)
    {
        $last_name1 = last_word($name1);
        $last_name2 = last_word($name2);

        if ($last_name1 === $last_name2)
        {
            $last_name2 = last_word(trim(str_replace($last_name2,'', $name2)));
        }

        return $last_name1 . ' ' . $last_name2;
    }

    public function applyMutation()
    {
        $skill = array_rand(static::ATTR_RANGE);
        $this->$skill = mt_rand(static::ATTR_RANGE[$skill][0], static::ATTR_RANGE[$skill][1]);
    }
}