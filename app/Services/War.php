<?php

namespace App\Service;

use App\Model\Fighter;
use App\Model\Fighters\Giant;
use App\Model\Fighters\Hero;
use App\Model\Fighters\HeroChild;
use App\Service\Contract\WarInterface;
use App\Service\Contract\BattleInterface;

class War implements WarInterface
{
    const FIGHTERS = 4;
    const MAX_GENERATIONS = 30;
    private $battleService;
    private $cyclopes;
    private $genarations;

    /**
     * @param BattleInterface $battleService
     */
    public function __construct(BattleInterface $battleService)
    {
        $this->battleService = $battleService;
        $this->cyclopes = new Giant("Cyclops");
    }

    public function startWar()
    {
        $heroes = [];
        for($fighters = 1; $fighters <= self::FIGHTERS; $fighters++)
        {
            $heroes[] = new Hero(hero_name());
        }

        $this->generationWar($heroes);

        return $this->genarations;
    }

    private function generationWar(array $heroes, $generation = 1)
    {
        if ($generation > self::MAX_GENERATIONS)
        {
            return true;
        }
        $results = $fights = [];

        foreach ($heroes as $hero)
        {
            $this->cyclopes->resetHealth();
            $this->battleService->fight($hero, $this->cyclopes);
            $result = $this->battleService->getLogs();
            $fights[] = $result;

            if ($result['winner'] == $hero->getName())
            {
                $this->genarations[$generation] = [
                    'Generation'       => $generation,
                    'fights'           => $fights,
                    'winner'           => $result['winner'],
                ];
                return true;
            }

            $lastRound = last($result['rounds']);
            $results[] = [
                'rounds' => count($result['rounds']),
                'remainingHealth' => $lastRound['attacker']['initialHealth'],
                'log' => $result,
                'hero' => $hero,
            ];
        }

        usort($results, function($a, $b) {
            return $b['rounds'] <=> $a['rounds'];
        });

        $this->genarations[$generation] = [
            'Generation'       => $generation,
            'fights'           => $fights,
            'naturalSelection' => [$results[0]['hero']->getName(), $results[1]['hero']->getName()]
        ];

        $heroes = $this->warChildren($results[0]['hero'], $results[1]['hero']);

        $this->generationWar($heroes, $generation+1);
    }

    private function warChildren(Fighter $hero1, Fighter $hero2)
    {
        $children = [];

        for($child = 0; $child < self::FIGHTERS; $child++)
        {
            if ($child === 0)
            {
                $children[] = new HeroChild($hero1, $hero2);
                continue;
            }

            $heroChild = new HeroChild($hero1, $hero2);
            $heroChild->applyMutation();
            $children[] = $heroChild;
        }

        return $children;
    }
}