<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction\support;

use DaPigGuy\PiggyFactions\players\PlayerManager;

use pocketmine\player\Player;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\DV;

class PiggyFactionSupport extends FactionSupport{

    /**
     * @param Player $player
     */
    public function getFaction(Player $player){
        $factionName = null;
        $faction = PlayerManager::getInstance()->getPlayerFaction($player->getUniqueId());
        if(!is_null($faction)) $factionName = $faction->getName();
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;         
    }

    /**
     * @param Player $player
     */
    public function getFactionRank(Player $player){
        $factionRank = null;
        $member = PlayerManager::getInstance()->getPlayer($player);
        $faction = $member === null ? null : $member->getFaction();
        if(!is_null($faction)) $factionRank = $member->getRole();
        if($factionRank === "" || is_null($factionRank)) $factionRank = DV::getInstance()->config->getNested("Faction.no-faction-rank");
        return $factionRank;
    }

    /**
     * @param Player $player
     */
    public function getFactionPower(Player $player){
        $factionPower = null;
        $member = PlayerManager::getInstance()->getPlayer($player);
        $faction = $member === null ? null : $member->getFaction();
        if(!is_null($faction)) $factionPower = $member->getPower();
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}