<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM;

use pocketmine\event\Listener;

use pocketmine\event\server\DataPacketReceiveEvent;

use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemOnEntityTransactionData;

use fernanACM\DeviceACM\utils\PluginUtils;

class Event implements Listener{

    public function onDataPacketReceive(DataPacketReceiveEvent $event){
        $player = $event->getOrigin()->getPlayer();
        $packet = $event->getPacket();
        if($packet instanceof InventoryTransactionPacket){
            if($packet->trData instanceof UseItemOnEntityTransactionData){
                PluginUtils::setCps($player);
            }
        }
    }
}