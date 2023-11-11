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
# LIb
use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;
# My files
use fernanACM\DeviceACM\task\DeviceTask;

use fernanACM\DeviceACM\Event;

use fernanACM\DeviceACM\manager\DeviceManager;
use fernanACM\DeviceACM\utils\PluginUtils;

use fernanACM\DeviceACM\faction\FactionSupport;
use fernanACM\DeviceACM\faction\support\AdvancedFactionsSupport;
use fernanACM\DeviceACM\faction\support\BedrockClansSupport;
use fernanACM\DeviceACM\faction\support\FactionMasterSupport;
use fernanACM\DeviceACM\faction\support\PiggyFactionSupport;
use fernanACM\DeviceACM\faction\support\SimpleFactionSupport;

class DV extends PluginBase{

    /** @var Config $config */
    public Config $config;
    
    /** @var DV $instance */
    private static DV $instance;
    # Faction
	private static $factionType;
    # CheckConfig
    private const CONFIG_VERSION = "4.0.0";

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
    private function loadFiles(): void{
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
    }

    /**
     * @return void
     */
    private function loadCheck(): void{
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
    private function loadVirions(): void{
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
    private function loadFaction(): void{
        if(boolval($this->config->get("FactionSupport")) === true){
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
                if($plugin instanceof \rxduz\factions\Main){
                    $this->getLogger()->notice("AdvancedFactions factions support has been loaded.");
                    self::$factionType = new AdvancedFactionsSupport($plugin);
                    return;
                }
            }
        }
        $this->getLogger()->critical("Faction support has been canceled because it has not been found");
    }

    /**
     * @return void
     */
    private function loadEvents(): void{
        Server::getInstance()->getPluginManager()->registerEvents(new Event, $this);
        $this->getScheduler()->scheduleRepeatingTask(new DeviceTask(), 11);
    }

    /**
     * @return DeviceManager
     */
    public function getDeviceManager(): DeviceManager{
        return DeviceManager::getInstance();
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
        return PluginUtils::getDeviceCode($player, $message);
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
