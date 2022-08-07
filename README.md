### Geral

PlayScript is a plugin that allows you to run PHP code directly from the server by command.

### How to use
- Move your PHP code (must have a .php extension) to the "scripts" folder
- It doesn't matter if the server is on or not, it will catch anyway
- type the command /playscript <file> and watch the magic happen

### Script example
an example script is already generated in the plugin itself, below is an example script
```php
<?php

use pocketmine\player\Player;

$p = $this->getServer()->getPlayerByPrefix("LadinoXx");
if (!$p instanceof Player) {
    print_r("no player\n");
}else{
    $p->sendMessage("...");
}
```
