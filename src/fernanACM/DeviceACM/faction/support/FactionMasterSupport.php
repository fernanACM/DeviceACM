<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction\support;

use ShockedPlot7560\FactionMaster\API\MainAPI;

use pocketmine\player\Player;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\DV;

class FactionMasterSupport extends FactionSupport{

    /**
     * @param Player $player
     * @return string
     */
    public function getFaction(Player $player): string{
        $factionName = null;
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if(!is_null($faction)) $factionName = $faction->getName();
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;         
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionRank(Player $player): string{
        $factionRank = null;
        $member = MainAPI::getUser($player->getName());
        if(!is_null($member)) $factionRank = $member->getRank();
        if($factionRank === "" || is_null($factionRank)) $factionRank = DV::getInstance()->config->getNested("Faction.no-faction-rank");
        return $factionRank;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionPower(Player $player): string{
        $factionPower = null;
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if(!is_null($faction)) $factionPower = $faction->getPower();
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}