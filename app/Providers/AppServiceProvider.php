<?php

namespace App\Providers;

use App\Service\Battle;
use App\Service\BattleLog;
use App\Service\Contract\BattleInterface;
use App\Service\Contract\BattleLogInterface;
use App\Service\Contract\WarInterface;
use App\Service\War;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BattleInterface::class, Battle::class);
        $this->app->bind(BattleLogInterface::class, BattleLog::class);
        $this->app->bind(WarInterface::class, War::class);
    }
}
