<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction\support;

use Wertzui123\BedrockClans\Main;
use Wertzui123\BedrockClans\Clan;

use pocketmine\player\Player;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\DV;

class BedrockClansSupport extends FactionSupport{

    /**
     * @param Player $player
     * @return string
     */
    public function getFaction(Player $player): string{
        $factionName = null;
        $faction = Main::getInstance()->getPlayer($player)->getClan();
        if(!is_null($faction)) $factionName = $faction->getDisplayName();
        if($factionName === "" || is_null($factionName)) $factionName = DV::getInstance()->config->getNested("Faction.no-faction");
        return $factionName;         
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionRank(Player $player): string{
        $factionRank = null;
        $member = Main::getInstance()->getPlayer($player)->getClan();
        if(!is_null($member)){
            $rank = $member->getRank($player);
            if(!is_null($rank))
                $factionRank = Clan::getRankName($rank, true);
        }
        if($factionRank === "" || is_null($factionRank)) $factionRank = DV::getInstance()->config->getNested("Faction.no-faction-rank");
        return $factionRank;
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getFactionPower(Player $player): string{
        return "0";
    }
}