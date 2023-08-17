<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;

use fernanACM\DeviceACM\manager\DeviceManager;
use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;

class Event implements Listener{

    /**
     * @param DataPacketReceiveEvent $event
     * @return void
     */
    public function onDataPacketReceive(DataPacketReceiveEvent $event): void{
        $player = $event->getOrigin()->getPlayer();
        $packet = $event->getPacket();
        if($packet instanceof InventoryTransactionPacket){
            if($packet->trData->getTypeId() == InventoryTransactionPacket::TYPE_USE_ITEM_ON_ENTITY){
                DeviceManager::getInstance()->setCps($player);
            }
        }
        if($packet instanceof LevelSoundEventPacket and $packet->sound == 42){
            DeviceManager::getInstance()->setCps($player);
         }
        if($event->getPacket()->pid() === AnimatePacket::NETWORK_ID) {
            NetworkBroadcastUtils::broadcastPackets($player->getViewers(), [$event->getPacket()]);
            $event->cancel();
        }
    }

    /**
     * @param EntityDamageByEntityEvent $event
     * @return void
     */
    public function onDamage(EntityDamageByEntityEvent $event): void{
        $entity = $event->getEntity();
        $damager = $event->getDamager();
        if(!($damager instanceof Player) || !($entity instanceof Player))return;
        $properties = [
            "{VICTIM_NAME}" => $entity->getName(),
            "{VICTIM_PING}" => $entity->getNetworkSession()->getPing(),
            "{VICTIM_HEALTH}" => $entity->getHealth(),
            "{VICTIM_MAX_HEALTH}" => $entity->getMaxHealth(),
            "{VICTIM_FOOD}" => $entity->getHungerManager()->getFood(),
            "{VICTIM_MAX_FOOD}" => $entity->getHungerManager()->getMaxFood(),
            "{VICTIM_PING}" => $entity->getNetworkSession()->getPing(),
            "{VICTIM_DEVICE}" => DeviceManager::getInstance()->getPlayerPlatform($entity),
            "{VICTIM_WORLD}" => $entity->getWorld()->getFolderName(),
            "{VICTIM_CPS}" => DeviceManager::getInstance()->getCps($entity),
            "{VICTIM_REACH}" => DeviceManager::getInstance()->getReach($entity)
        ];
        if(DeviceManager::getInstance()->getWorldsEnabled($damager, DeviceManager::POPUP) and DeviceManager::getInstance()->getWorldsEnabled($entity, DeviceManager::POPUP)){
            if(DV::getInstance()->config->getNested("Popuptag.enabled")){
                DeviceManager::getInstance()->sendPoup($damager, strtr(DV::getScore($damager, "Popuptag.line"), $properties));
            }
        }
    }
}