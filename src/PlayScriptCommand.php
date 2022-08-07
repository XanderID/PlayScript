<?php

namespace LadinoXx\PlayScript;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use LadinoXx\PlayScript\Main;

class PlayScriptCommand extends Command {

    /**
     * @var Main
     */
    public Main $plugin;

    /**
     * @param Main $plugin
     */
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
        parent::__construct("playscript", "run a script in php", "Usage : /playscript <string: filename>", ["ps"]);
        $this->setPermission("script.execute");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) return;
        if (!isset($args[0])) {
            $sender->sendMessage("§cUsage : /playscript <string: filename>");
            return;
        }
        if (!file_exists($this->plugin->getDataFolder() . "scripts/" . $args[0])) {
            $sender->sendMessage("§cFile " . $args[0] . " does not exist");
            return;
        }
        $this->plugin->executeScript(file_get_contents($this->plugin->getDataFolder() . "scripts/" . $args[0]));
    }
}