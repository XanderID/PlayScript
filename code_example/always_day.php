<?php

use pocketmine\scheduler\ClosureTask;

$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() {
    foreach ($this->getServer()->getWorldManager()->getWorlds() as $w) {
        $w->setTime(1000);
        $w->stopTime();
    }
}), 20*300);