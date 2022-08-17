<?php

namespace LadinoXx\PlayScript;

use FilesystemIterator;
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
        parent::__construct("playscript", "run a script in php", "§cUsage : /playscript <string: filename|string: list>", ["ps"]);
        $this->setPermission("playscript.command");
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
            $sender->sendMessage("§cUsage : /playscript <string: filename|string: list>");
            return;
        }
        if ($args[0] == "list") {
            $message = "§cfile list:";
            foreach(new FilesystemIterator($this->plugin->getDataFolder() . "scripts") as $file) {
                $message .= "\n§c - " . $file->getFilename() . " §a(" . $file->getSize() . "KB)";
            }
            $sender->sendMessage($message);
            return;
        }
        if (!file_exists($this->plugin->getDataFolder() . "scripts/" . $args[0])) {
            $sender->sendMessage("§cFile " . $args[0] . " does not exist, file list:");
            $message = "";
            foreach(new FilesystemIterator($this->plugin->getDataFolder() . "scripts") as $file) {
                $message .= "\n§c - " . $file->getFilename() . " §a(" . $file->getSize() . "KB)";
            }
            $sender->sendMessage($message);
            return;
        }
        $this->plugin->executeScript($args[0]);
    }
}