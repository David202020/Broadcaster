<?php

namespace Broadcaster;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

use Broadcaster\Main;

class Task extends PluginTask {

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
		$this->length = -1;
    }

    public function onRun($currentTick){
    	$this->plugin = $this->getOwner();
    	$this->cfg = new Config($this->plugin->getDataFolder()."broadcaster.yml", Config::YAML);
    	if($this->cfg["broadcast-enabled"]==true){
    		$this->length=$this->length+1;
    		$messages = $this->cfg["messages"];
    		$messagekey = $this->length;
    		$message = $messages[$messagekey];
    		if($this->length==count($messages)-1) $this->length = -1;
    		Server::getInstance()->broadcastMessage($this->plugin->broadcast($this->cfg, $message));
    	}
    }

}
?>
