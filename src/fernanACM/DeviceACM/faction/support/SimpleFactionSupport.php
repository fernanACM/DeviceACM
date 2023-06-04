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

    /**
     * @param Player $player
     * @return string
     */
    public function getFaction(Player $player): string{
        $factionName = null;
        $factionName = FactionsAPI::getFaction($player->getName());
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionRank(Player $player): string{
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

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionPower(Player $player): string{
        $factionPower = null;
        $factionPower = FactionsAPI::getPower(FactionsAPI::getFaction($player));
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}