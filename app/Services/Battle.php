<?php

namespace App\Service;

use App\Model\Fighter;
use App\Service\Contract\BattleInterface;
use App\Service\Contract\BattleLogInterface;

class Battle implements BattleInterface
{
    const MAX_ROUNDS = 20;

    private $battleLog;

    /**
     * @param BattleLogInterface $battleLog
     */
    public function __construct(BattleLogInterface $battleLog)
    {
        $this->battleLog = $battleLog;
    }

    public function fight(Fighter $hero, Fighter $monster)
    {
        $winner = null;
        $this->battleLog->logFighters($hero, $monster);

        $attacker = $this->chooseAttacker($hero, $monster);
        $defender = ($attacker === $hero) ? $monster : $hero;

        for ($round = 1; $round <= 20; $round++)
        {
            $this->battleLog->logRoundStart($round, $attacker, $defender);
            $winner = $this->round($attacker, $defender);
            if ($winner)
            {
                break;
            }
            $attackerTmp = $defender;
            $defender = $attacker;
            $attacker = $attackerTmp;
        }

        $this->battleLog->logBattleResult($winner);
    }

    /**
     * @param Fighter $hero
     * @param Fighter $monster
     * @return Fighter
     */
    private function chooseAttacker(Fighter $hero, Fighter $monster)
    {
        if ($hero->getSpeed() == $monster->getSpeed())
        {
            return ($hero->getLuck() > $monster->getLuck()) ? $hero : $monster;
        }

        return ($hero->getSpeed() > $monster->getSpeed()) ? $hero : $monster;
    }

    /**
     * @param Fighter $attacker
     * @param Fighter $defender
     * @return Fighter|bool
     */
    private function round(Fighter $attacker, Fighter $defender)
    {
        $attack = $attacker->attack();
        $damage = $defender->defend($attack['damage']);
        $defender->setDamageTaken($damage['damage']);

        $this->battleLog->logRound($attack, $damage, $defender->getHealth());

        if ($defender->getHealth() <= 0)
        {
            return $attacker;
        }

        return false;
    }

    public function getLogs() : array
    {
        return $this->battleLog->outputLog();
    }
}