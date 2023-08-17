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
        if(FactionsAPI::isInFaction($player->getName()))$factionName = FactionsAPI::getFaction($player->getName());
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionRank(Player $player): string{
        $factionRank = null;
        if(FactionsAPI::isInFaction($player->getName())){
            if(FactionsAPI::getRank($player->getName()) === "Leader"){
                return $factionRank = "Leader";
            }elseif(FactionsAPI::getRank($player->getName()) === "Officer"){
                return $factionRank = "Officer";
            }
        }
        if($factionRank === "" || is_null($factionRank)) $factionRank = DV::getInstance()->config->getNested("Faction.no-faction-rank");
        return $factionRank;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionPower(Player $player): string{
        $factionPower = null;
        if(FactionsAPI::isInFaction($player->getName()))$factionPower = FactionsAPI::getPower(FactionsAPI::getFaction($player));
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}