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

use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;

use fernanACM\DeviceACM\task\DeviceTask;

use fernanACM\DeviceACM\Event;

use fernanACM\DeviceACM\utils\PluginUtils;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\faction\support\BedrockClansSupport;
use fernanACM\DeviceACM\faction\support\FactionMasterSupport;
use fernanACM\DeviceACM\faction\support\PiggyFactionSupport;
use fernanACM\DeviceACM\faction\support\SimpleFactionSupport;

class DV extends PluginBase{
    # Config
    public Config $config;
    /** @var DV $instance */
    public static DV $instance;
    # Faction
	public static $factionType;
    # CheckConfig
    public const CONFIG_VERSION = "2.0.0";

    /**
     * @return void
     */
    public function onLoad(): void{
        self::$instance = $this;
        $this->loadFiles();
    }

    /**
     * @return void
     */
    public function onEnable(): void{
        $this->loadCheck();
        $this->loadVirions();
        $this->loadFaction();
        $this->loadEvents();
    }

    /**
     * @return void
     */
    public function loadEvents(): void{
        Server::getInstance()->getPluginManager()->registerEvents(new Event(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new DeviceTask(), 11);
    }

    /**
     * @return void
     */
    public function loadFiles(): void{
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
    }

    /**
     * @return void
     */
    public function loadCheck(): void{
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
    }

    /**
     * @return void
     */
    public function loadVirions(): void{
        foreach([
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download DeviceACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        # Update
        libPiggyUpdateChecker::init($this);
    }

    /**
     * @return void
     */
    public function loadFaction(): void{
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
                if($plugin instanceof \Wertzui123\BedrockClans\Main){
                    $this->getLogger()->notice("BedrockClans factions support has been loaded.");
                    self::$factionType = new BedrockClansSupport($plugin);
                    return;
                }
                if($plugin instanceof \ShockedPlot7560\FactionMaster\FactionMaster){
                    $this->getLogger()->notice("FactionMaster factions support has been loaded.");
                    self::$factionType = new FactionMasterSupport($plugin);
                    return;
                }
            }
        }
        $this->getLogger()->critical("Faction support has been canceled because it has not been found");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerPlatform(Player $player): string{
        $extraData = $player->getPlayerInfo()->getExtraData();
        $config = self::$instance->config;
        if($extraData["DeviceOS"] === DeviceOS::ANDROID && $extraData["DeviceModel"] === ""){
            return "Linux";
        }
        return match($extraData["DeviceOS"]){
            DeviceOS::ANDROID => $config->getNested("Platform.Android"),
            DeviceOS::IOS => $config->getNested("Platform.iOS"),
            DeviceOS::OSX => $config->getNested("Platform.macOS"),
            DeviceOS::AMAZON => $config->getNested("Platform.FireOS"),
            DeviceOS::GEAR_VR => $config->getNested("Platform.GearVR"),
            DeviceOS::HOLOLENS => $config->getNested("Platform.Hololens"),
            DeviceOS::WINDOWS_10 => $config->getNested("Platform.Windows10"),
            DeviceOS::WIN32 => $config->getNested("Platform.Windows7"),
            DeviceOS::DEDICATED => $config->getNested("Platform.Dedicated"),
            DeviceOS::TVOS => $config->getNested("Platform.TVOS"),
            DeviceOS::PLAYSTATION => $config->getNested("Platform.PlayStation"),
            DeviceOS::NINTENDO => $config->getNested("Platform.NintendoSwitch"),
            DeviceOS::XBOX => $config->getNested("Platform.Xbox"),
            DeviceOS::WINDOWS_PHONE => $config->getNested("Platform.WindowsPhone"),
            default => $config->getNested("Platform.Unknown")
        };
    }

    /**
     * @param Player $player
     * @param string $key
     * @return string
     */
    public static function getScore(Player $player, string $key): string{
        $messageArray = self::$instance->config->getNested($key, []);
        if(!is_array($messageArray)){
            $messageArray = [$messageArray];
        }
        $message = implode("\n", $messageArray);
        return PluginUtils::DeviceCode($player, $message);
    }

    /**
     * @return FactionSupport
     */
    public static function getFactionType(): FactionSupport{
        return self::$factionType;
    }

    /**
     * @return DV
     */
    public static function getInstance(): DV{
        return self::$instance;
    }
}
