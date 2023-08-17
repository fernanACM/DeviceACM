<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\task;

use pocketmine\Server;

use pocketmine\scheduler\Task;

use fernanACM\DeviceACM\DV;
use fernanACM\DeviceACM\manager\DeviceManager;

class DeviceTask extends Task{

	/**
	 * @return void
	 */
	public function onRun(): void{
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			if(DeviceManager::getInstance()->getWorldsEnabled($player, DeviceManager::DEVICE)){
				$player->setNameTagVisible();
				$player->setScoreTag(DV::getScore($player, "Devicetag.line"));
				// FACTION SUPPORT
				if(DV::getFactionType()){
					$data = DV::getScore($player, "Devicetag.line");
					$facType = DV::getFactionType();
					$faction = str_replace(["{FACTION}", "{FACTION_RANK}", "{FACTION_POWER}"], [$facType->getFaction($player), $facType->getFactionRank($player), $facType->getFactionPower($player)], $data);
					$player->setScoreTag($faction);
				}
			}else{
				$player->setNameTagVisible();
				$player->setScoreTag("");
			}
		}
	}
}
