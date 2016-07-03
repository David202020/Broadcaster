<?php
namespace Broadcaster;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\{Config, TextFormat};
use pocketmine\command\{CommandExecutor, CommandSender};

class Main extends PluginBase{

    const PREFIX = "&9[&eBroadcaster&9] ";
    public $cfg;
    public $task;
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
        $time = intval($this->cfg["time"]) * 20;
        $ptime = intval($this->cfg["popup-time"]) * 20;
        $this->task = $this->getServer()->getScheduler()->scheduleRepeatingTask(new Tasks\Task($this), $time);
        $this->ptask = $this->getServer()->getScheduler()->scheduleRepeatingTask(new Tasks\PopupTask($this), $ptime);
    }

	public function getMessagefromArray($array){
		unset($array[0]);
		return implode(' ', $array);
	}
	
}
?>
