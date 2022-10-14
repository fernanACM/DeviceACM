<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction\support;

use Ayzrix\SimpleFaction\API\FactionsAPI;

use pocketmine\player\Player;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\DV;

class SimpleFactionSupport extends FactionSupport{

    public function getFaction(Player $player){
        $factionName = null;
        $factionName = FactionsAPI::getFaction($player->getName());
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;
    }

    public function getFactionRank(Player $player){
        $factionRank = null;
        foreach(FactionsAPI::getAllPlayers(FactionsAPI::getFaction($player->getName())) as $players){
            if(FactionsAPI::getRank($players) === "Leader") {
                return $factionRank = "Leader";
            }elseif(FactionsAPI::getRank($players) === "Officer") {
                return $factionRank = "Officer";
            }
        }
        if($factionRank === "" || is_null($factionRank)) $factionRank = DV::getInstance()->config->getNested("Faction.no-faction-rank");
        return "NO RANK";
    }

    public function getFactionPower(Player $player){
        $factionPower = null;
        $factionPower = FactionsAPI::getPower(FactionsAPI::getFaction($player));
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}