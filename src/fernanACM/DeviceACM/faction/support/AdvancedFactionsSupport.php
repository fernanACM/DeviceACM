<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction\support;

use rxduz\factions\faction\FactionManager;
use rxduz\factions\player\PlayerManager;

use pocketmine\player\Player;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\DV;

class AdvancedFactionsSupport extends FactionSupport{

    /**
     * @param Player $player
     * @return string
     */
    public function getFaction(Player $player): string{
        $factionName = null;
        $session = PlayerManager::getInstance()->getSessionByName($player->getName());
        if(!is_null($session = PlayerManager::getInstance()->getSessionByName($player->getName()))){
            if(!is_null($faction = $session->getFaction())){
                if(!is_null($factionObject = FactionManager::getInstance()->getFactionByName($faction))){
                    $factionName = $factionObject->getName();
                }
            }
        }
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionRank(Player $player): string{
        $factionRank = null;
        $session = PlayerManager::getInstance()->getSessionByName($player->getName());
        if(!is_null($session = PlayerManager::getInstance()->getSessionByName($player->getName()))){
            if(!is_null($faction = $session->getFaction())){
                if(!is_null(FactionManager::getInstance()->getFactionByName($faction))){
                    $factionRank = $session->getRole();
                }
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
        $session = PlayerManager::getInstance()->getSessionByName($player->getName());
        if(!is_null($session = PlayerManager::getInstance()->getSessionByName($player->getName()))){
            if(!is_null($faction = $session->getFaction())){
                if(!is_null($factionObject = FactionManager::getInstance()->getFactionByName($faction))){
                    $factionPower = (string)round($factionObject->getPower(), 2, PHP_ROUND_HALF_DOWN);
                }
            }
        }
        if($factionPower === "" || is_null($factionPower)) $factionPower = "0";
        return $factionPower;
    }
}