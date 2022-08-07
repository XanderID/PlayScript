<?php

declare(strict_types=1);

namespace LadinoXx\PlayScript;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    /**
     * @return void
     */
    public function onEnable() : void
    {
        @mkdir($this->getDataFolder() . "scripts/");
        $this->saveResource("scripts/base.php");
        $this->getServer()->getCommandMap()->register("script", new PlayScriptCommand($this));
    }

    /**
     * @param string $code
     * @return void
     */
    public function executeScript(string $code) : void
    {
        $file = str_replace(["<?php"], [""], $code);
        eval($file);
    }
}
