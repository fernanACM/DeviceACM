<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\network\mcpe\protocol\types\DeviceOS;

use fernanACM\DeviceACM\task\DeviceTask;

use fernanACM\DeviceACM\Event;

use fernanACM\DeviceACM\utils\PluginUtils;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\faction\support\PiggyFactionSupport;
use fernanACM\DeviceACM\faction\support\SimpleFactionSupport;

class DV extends PluginBase{

    # Config
    public Config $config;
    # CheckConfig
    public const CONFIG_VERSION = "1.0.0";
    # Instance
    public static $instance;
    # Faction
	public static $factionType;

    public function onLoad(): void{
        self::$instance = $this;
    }

    public function onEnable(): void{
        $this->loadFiles();
        $this->loadCheck();
        $this->loadFaction();
        $this->loadEvents();
    }

    public function loadEvents(){
        Server::getInstance()->getPluginManager()->registerEvents(new Event($this), $this);
        $this->getScheduler()->scheduleRepeatingTask(new DeviceTask($this), 11);
    }

    public function loadFiles(){
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
    }

    public function loadCheck(){
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
    }

    public function loadFaction(){
        if($this->config->get("FactionSupport") === true){
            foreach(Server::getInstance()->getPluginManager()->getPlugins() as $plugin){
                if($plugin instanceof \DaPigGuy\PiggyFactions\PiggyFactions){
                    $this->getLogger()->notice("PiggyFactions factions support has been loaded.");
                    self::$factionType = new PiggyFactionSupport($plugin);
                    return;
                }
                if($plugin instanceof \Ayzrix\SimpleFaction\Main){
                    $this->getLogger()->notice("SimpleFaction factions support has been loaded.");
                    self::$factionType = new SimpleFactionSupport($plugin);
                    return;
                }
            }
        }
        $this->getLogger()->critical("Faction support has been canceled because it has not been found");
    }

    public static function getPlayerPlatform(Player $player): string{
        $extraData = $player->getPlayerInfo()->getExtraData();
        if($extraData["DeviceOS"] === DeviceOS::ANDROID && $extraData["DeviceModel"] === ""){
            return "Linux";
        }
        return match ($extraData["DeviceOS"]){
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

    public static function getScore(Player $player, string $key){
        return PluginUtils::DeviceCode($player, DV::getInstance()->config->getNested($key, $key));
    }

    public static function getFactionType(): FactionSupport{
        return self::$factionType;
    }

    public static function getInstance(): DV{
        return self::$instance;
    }
}
