<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\manager;

use fernanACM\DeviceACM\DV;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;

class DeviceManager{

    /** @var DeviceManager|null $instance */
    private static ?DeviceManager $instance = null;

    /** @var array $cps */
    private static array $cps = [];
    # ==(WorldManager)==
    private const BLACKLIST = "blacklist";
    private const WHITELIST = "whitelist";
    # ==(DeviceTag - Popup)==
    public const DEVICE = "Device";
    public const POPUP = "Popup";
    # ==(Popup)==
    private const TIP = "tip";
    private const DEFAULT = "popup";
    private const ACTION_BAR = "actionbar";

    private function __construct(){
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerPlatform(Player $player): string{
        $extraData = $player->getPlayerInfo()->getExtraData();
        $config = DV::getInstance()->config;
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
     * @return int
     */
    public function getCps(Player $player): int{
        if(!isset(self::$cps[$player->getDisplayName()])){
            return 0;
        }
        $time = self::$cps[$player->getDisplayName()][0];
        $cps = self::$cps[$player->getDisplayName()][1];
        if($time !== time()){
            unset(self::$cps[$player->getDisplayName()]);
            return 0;
        }
        return $cps;
    }

    /**
     * @param Player $player
     * @return void
     */
    public function setCps(Player $player): void{
        if(!isset(self::$cps[$player->getDisplayName()])){
            self::$cps[$player->getDisplayName()] = [time(), 0];
        }
        $time = self::$cps[$player->getDisplayName()][0];
        $cps = self::$cps[$player->getDisplayName()][1];
        if($time !== time()){
            $time = time();
            $cps = 0;
        }
        $cps++;
        self::$cps[$player->getDisplayName()] = [$time, $cps];
    }

    /**
     * @param Player $player
     * @return float
     */
    public function getReach(Player $player): float{
        $position = $player->getPosition();
        $x = abs($position->getX() - $position->getX());
        $z = abs($position->getZ() - $position->getZ());
        $reach = round(sqrt($x * $x + $z * $z), 2) + ($player->getNetworkSession()->getPing() * 0.002);
        return $reach;
    }    

    /**
     * @param Player $player
     * @param string $message
     * @return void
     */
    public function sendPoup(Player $player, string $message): void{
        $mode = DV::getInstance()->config->getNested("Popuptag.mode");
        switch(strtolower($mode)){
            case self::DEFAULT:
                $player->sendPopup($message);
            break;

            case self::TIP:
                $player->sendTip($message);
            break;

            case self::ACTION_BAR:
                $player->sendActionBarMessage($message);
            break;

            default:
                $player->sendPopup($message);
            break;
        }
    }

    /**
     * @param Player $player
     * @param string $type
     * @return boolean
     */
    public function getWorldsEnabled(Player $player, string $type): bool{
        $mode = DV::getInstance()->config->getNested("Settings.WorldManager.mode");
        switch(strtolower($mode)){
            case self::BLACKLIST:
                if($this->isBlacklistMode($player->getWorld()->getFolderName(), $type)){
                    return false;
                }
            break;
    
            case self::WHITELIST:
                if(!$this->isWhitelistMode($player->getWorld()->getFolderName(), $type)){
                    return false;
                }
            break;
    
            default:
                return $this->isWhitelistMode($player->getWorld()->getFolderName(), $type);
        }
        return true;
    }
    
    /**
     * @param string $worldName
     * @param string $mode
     * @return boolean
     */
    public function isWhitelistMode(string $worldName, string $mode): bool{
        $worldsWhitelist = DV::getInstance()->config->getNested("Settings.WorldManager.{$mode}.worlds-whitelist");
        return in_array($worldName, $worldsWhitelist);
    }
    
    /**
     * @param string $worldName
     * @param string $mode
     * @return boolean
     */
    public function isBlacklistMode(string $worldName, string $mode): bool{
        $worldsBlacklist = DV::getInstance()->config->getNested("Settings.WorldManager.{$mode}.worlds-blacklist");
        return !in_array($worldName, $worldsBlacklist);
    }

    /**
     * @return self
     */
    public static function getInstance(): self{
        if(is_null(self::$instance)) self::$instance = new self();
        return self::$instance;
    }
}