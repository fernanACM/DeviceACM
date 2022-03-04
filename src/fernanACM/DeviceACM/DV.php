<?php

namespace fernanACM\DeviceACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\network\mcpe\protocol\types\DeviceOS;

use fernanACM\DeviceACM\DeviceTask;

class DV extends PluginBase {
  
  public static $instance;
	
  public function onLoad(): void{
     self::$instance = $this;
  }
	
  public function onEnable(): void{
     $this->getScheduler()->scheduleRepeatingTask(new DeviceTask($this), 11);
  }
	
  public static function getInstance(){
  	return self::$instance;
  }
    
  public function getPlayerPlatform(Player $player): string {
        $extraData = $player->getPlayerInfo()->getExtraData();

        if ($extraData["DeviceOS"] === DeviceOS::ANDROID && $extraData["DeviceModel"] === "") {
            return "Linux";
        }

        return match ($extraData["DeviceOS"])
        {
            DeviceOS::ANDROID => "Android",
            DeviceOS::IOS => "iOS",
            DeviceOS::OSX => "macOS",
            DeviceOS::AMAZON => "FireOS",
            DeviceOS::GEAR_VR => "Gear VR",
            DeviceOS::HOLOLENS => "Hololens",
            DeviceOS::WINDOWS_10 => "Windows",
            DeviceOS::WIN32 => "Windows 7 (Edu)",
            DeviceOS::DEDICATED => "Dedicated",
            DeviceOS::TVOS => "TV OS",
            DeviceOS::PLAYSTATION => "PlayStation",
            DeviceOS::NINTENDO => "Nintendo Switch",
            DeviceOS::XBOX => "Xbox",
            DeviceOS::WINDOWS_PHONE => "Windows Phone",
            default => "Unknown"
        };
    }
}
