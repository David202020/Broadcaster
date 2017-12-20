<?php
namespace Broadcaster;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

    const PREFIX = "&7[&fSky&Lords&7] ";
    public $cfg;
    public $task;
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = new Config($this->getDataFolder()."broadcasts.yml", Config::YAML);
        $time = intval($this->cfg["time"]) * 20;
        $this->task = $this->getServer()->getScheduler()->scheduleRepeatingTask(new Tasks\Task($this), $time);
    }

	public function getMessagefromArray($array){
		unset($array[0]);
		return implode(' ', $array);
	}
	
}
?>
