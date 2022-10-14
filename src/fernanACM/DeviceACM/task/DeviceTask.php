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

class DeviceTask extends Task{

	public function onRun(): void{
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$player->setNameTagVisible();
			$player->setScoreTag(DV::getScore($player, "Devicetag.line"));
			// FACTION SUPPORT
			if(DV::$factionType){
				$data = DV::getScore($player, "Devicetag.line");
				$faction = str_replace(["{FACTION}", "{FACTION_RANK}", "{FACTION_POWER}"], [DV::getFactionType()->getFaction($player), DV::getFactionType()->getFactionRank($player), DV::getFactionType()->getFactionPower($player)], $data);
				$player->setScoreTag($faction);
			}
		}
	}
}
