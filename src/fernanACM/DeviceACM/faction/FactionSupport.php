<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\faction;

use pocketmine\player\Player;

abstract class FactionSupport{

    /**
     * @param Player $player
     * @return string
     */
    abstract public function getFaction(Player $player): string;

    /**
     * @param Player $player
     * @return string
     */
    abstract public function getFactionRank(Player $player): string;

    /**
     * @param Player $player
     * @return string
     */
    abstract public function getFactionPower(Player $player): string;
}