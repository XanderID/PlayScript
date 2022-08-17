<?php

declare(strict_types=1);

namespace LadinoXx\PlayScript;

use pocketmine\plugin\PluginBase;
use LadinoXx\PlayScript\PlayScriptCommand;

class Main extends PluginBase{

    /**
     * @return void
     */
    public function onEnable() : void
    {
        @mkdir($this->getDataFolder() . "scripts/");
        $this->saveResource("scripts/base.php");
        $this->saveDefaultConfig();
        $this->getServer()->getCommandMap()->register("script", new PlayScriptCommand($this));
        foreach($this->getConfig()->get("run-scripts") as $filename) {
            if (!file_exists($this->getDataFolder() . "scripts/" . $filename)) {
                $this->getLogger()->warning("§ciFle " . $filename . " does not exist");
            }else{
                $this->executeScript($filename);
            }
        }
    }

    /**
     * @param string $path
     * @return void
     */
    public function executeScript(string $path) : void
    {
        include($this->getDataFolder() . "scripts/" . $path);
    }
}
