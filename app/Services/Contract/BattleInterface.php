<?php

namespace App\Service\Contract;

use App\Model\Fighter;

interface BattleInterface
{
    /**
     * @param Fighter $hero
     * @param Fighter $monster
     */
    public function fight(Fighter $hero, Fighter $monster);

    /**
     * @return array
     */
    public function getLogs(): array;
}