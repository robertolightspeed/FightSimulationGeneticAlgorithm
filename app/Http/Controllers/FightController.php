<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\Fighters\Hero;
use App\Model\Fighters\Monster;
use App\Service\Contract\BattleInterface;
use App\Service\Contract\WarInterface;

/**
 * Class FightController
 */
class FightController extends Controller
{
    private $battleService;
    private $warService;

    /**
     * FightController constructor.
     *
     * @param BattleInterface $battleService
     * @param WarInterface    $warService
     */
    public function __construct(BattleInterface $battleService, WarInterface $warService)
    {
        $this->battleService = $battleService;
        $this->warService = $warService;
    }

    public function fightAction()
    {
        $this->battleService->fight(new Hero("Dugim"), new Monster("Wild Beast"));
        return response()->json($this->battleService->getLogs());
    }

    public function warAction()
    {
        return response()->json($this->warService->startWar());
    }
}
