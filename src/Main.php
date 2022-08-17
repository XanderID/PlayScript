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
                $this->executeScript(file_get_contents($this->getDataFolder() . "scripts/" . $filename));
                $this->getLogger()->info("§aFile " . $filename . " was executed.");
            }
        }
    }

    /**
     * @param string $code
     * @return void
     */
    public function executeScript(string $code) : void
    {
        $execute = '/' . preg_quote("<?php", '/') . '/';
        $execute = preg_replace($execute, "", $code, 1);
        eval($execute);
    }
}
