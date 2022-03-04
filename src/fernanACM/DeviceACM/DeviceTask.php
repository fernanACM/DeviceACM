<?php

namespace fernanACM\DeviceACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\scheduler\Task;

class DeviceTask extends Task{
	public function __construct(Plugin $plugin){
		$this->api = $plugin;
	}

	public function onRun(): void{
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$player->setNameTagVisible();
			#Thanks to virvolta
			$player->setScoreTag("§c♥ ".$player->getHealth()."§f |  ".$player->getHungerManager()->getFood()."\n§aPing§f: ".$player->getNetworkSession()->getPing()." | §b§o".$this->api->getPlayerPlatform($player));
		}
	}
}
