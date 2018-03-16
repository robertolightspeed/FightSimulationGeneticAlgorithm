<?php

namespace App\Model;

abstract class Fighter
{
    const ATTACK_SKILL  = 'Normal Attack';
    const DEFENSE_SKILL = 'Normal Defense';

    const ATTR_RANGE = [
        "health" => [0,100],
        "strength" => [0,100],
        "defense" => [0,100],
        "speed" => [0,100],
        "luck" => [0,100],
    ];

    protected $name;
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;
    protected $initialHealth;

    protected $attackAbilities = [];
    protected $defenseAbilities = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $damage
     */
    public function setDamageTaken($damage)
    {
        $damage = $damage - $this->getDefense();
        if ($damage < 1)
        {
            $damage = 0;
        }

        $this->health = $this->health - $damage;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @return mixed
     */
    public function getInitialHealth()
    {
        return $this->initialHealth;
    }

    public function resetHealth()
    {
        $this->health = $this->initialHealth;
    }

    public function attack()
    {
        $attack = [
            'skill' => static::ATTACK_SKILL,
            'damage' => $this->getStrength()
        ];

        foreach ($this->attackAbilities as $ability)
        {
            if($ability->isTrigger())
            {
                $attack = [
                    'skill' => $ability->getName(),
                    'damage' => $ability->action($this->getStrength())
                ];
                break;
            }
        }

        return $attack;
    }

    public function defend($damageTaken)
    {
        $defend = [
            'skill' => static::DEFENSE_SKILL,
            'damage' => $damageTaken
        ];

        foreach ($this->defenseAbilities as $ability)
        {
            if($ability->isTrigger())
            {
                $defend = [
                    'skill' => $ability->getName(),
                    'damage' => $ability->action($damageTaken)
                ];
                break;
            }
        }

        return $defend;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $attackAbilities = [];
        foreach ($this->attackAbilities as $ability)
        {
            $attackAbilities[] = $ability->getName();
        }

        $defenseAbilities = [];
        foreach ($this->defenseAbilities as $ability)
        {
            $defenseAbilities[] = $ability->getName();
        }

        return [
            'name'             => $this->getName(),
            'health'           => $this->getHealth(),
            'strength'         => $this->getStrength(),
            'defense'          => $this->getDefense(),
            'speed'            => $this->getSpeed(),
            'luck'             => $this->getLuck(),
            'attackAbilities'  => $attackAbilities,
            'defenseAbilities' => $defenseAbilities,
        ];
    }
}