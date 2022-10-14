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

    abstract public function getFaction(Player $player);

    abstract public function getFactionRank(Player $player);

    abstract public function getFactionPower(Player $player);
}