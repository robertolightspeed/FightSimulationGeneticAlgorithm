<?php
/**
 * Created by PhpStorm.
 * User: robertodugim
 * Date: 16/03/2018
 * Time: 10:59
 */

namespace App\Service;

use App\Model\Fighter;
use App\Service\Contract\BattleLogInterface;

class BattleLog implements BattleLogInterface
{
    private $currentRound;
    private $rounds = [];
    private $hero = [];
    private $monster = [];
    private $winner = 'No Winner';

    /**
     * @inheritdoc
     */
    public function logFighters(Fighter $hero, Fighter $monster) : void
    {
        $this->hero    = $hero->toArray();
        $this->monster = $monster->toArray();
        $this->rounds  = [];
        $this->winner  = 'No Winner';
    }

    /**
     * @inheritdoc
     */
    public function logRoundStart(int $roundNumber, Fighter $attacker, Fighter $defender) : void
    {
        $this->currentRound = $roundNumber;
        $this->rounds[$roundNumber] = [
            'round' => $roundNumber,
            'attacker' => [
                'name'          => $attacker->getName(),
                'initialHealth' => $attacker->getHealth(),
            ],
            'defender' => [
                'name'          => $defender->getName(),
                'initialHealth' => $defender->getHealth(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function logRound(array $attack, array $damage, $defenderHealth) : void
    {
        $this->rounds[$this->currentRound]['attacker'] += $attack;
        $this->rounds[$this->currentRound]['defender'] += $damage;
        $this->rounds[$this->currentRound]['defender']['damageTaken'] = $this->rounds[$this->currentRound]['defender']['initialHealth'] - $defenderHealth;

        $this->rounds[$this->currentRound]['defender']['remainingHealth'] = $defenderHealth;
    }

    /**
     * @inheritdoc
     */
    public function logBattleResult($winner) : void
    {
        if ($winner)
        {
            $this->winner = $winner->getName();
        }
    }

    /**
     * @inheritdoc
     */
    public function outputLog() : array
    {
        return $this->buildLog();
    }

    /**
     * @return array
     */
    private function buildLog()
    {
        return [
            'hero' => $this->hero,
            'monster' => $this->monster,
            'rounds' => $this->rounds,
            'winner' => $this->winner
        ];
    }
}