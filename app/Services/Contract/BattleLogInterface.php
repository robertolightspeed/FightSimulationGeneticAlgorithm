<?php

namespace App\Service\Contract;

use App\Model\Fighter;

interface BattleLogInterface
{
    /**
     * @param Fighter $hero
     * @param Fighter $monster
     */
    public function logFighters(Fighter $hero, Fighter $monster) : void;

    /**
     * @param int     $roundNumber
     * @param Fighter $attacker
     * @param Fighter $defender
     */
    public function logRoundStart(int $roundNumber, Fighter $attacker, Fighter $defender)  : void;

    /**
     * @param array $attack
     * @param array $damage
     * @param       $defenderHealth
     */
    public function logRound(array $attack, array $damage, $defenderHealth)  : void;

    /**
     * @param Fighter|null $winner
     */
    public function logBattleResult($winner)  : void;

    /**
     * @return array
     */
    public function outputLog() : array;
}