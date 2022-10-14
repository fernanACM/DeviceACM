<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\DeviceACM\utils;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat;

use fernanACM\DeviceACM\DV;

class PluginUtils{

    public static $cps = [];

    /**
     * @param Player $player
     * @param string $score
     */
    public static function DeviceCode(Player $player, string $score): string{
        $replacements = [
            "{LINE}" => "\n",
            "{HEALTH}" => $player->getHealth(),
            "{MAX_HEALTH}" => $player->getMaxHealth(),
            "{FOOD}" => $player->getHungerManager()->getFood(),
            "{MAX_FOOD}" => $player->getHungerManager()->getMaxFood(),
            "{PING}" => $player->getNetworkSession()->getPing(),
            "{DEVICE}" => DV::getPlayerPlatform($player),
            "{WORLD}" => $player->getWorld()->getFolderName(),
            "{CPS}" => self::getCps($player),
            // EXTRA
            "&" => "§",
            "{BLACK}" => TextFormat::BLACK,
            "{DARK_BLUE}" => TextFormat::DARK_BLUE,
            "{DARK_GREEN}" => TextFormat::DARK_GREEN,
            "{CYAN}" => TextFormat::DARK_AQUA,
            "{DARK_RED}" => TextFormat::DARK_RED,
            "{PURPLE}" => TextFormat::DARK_PURPLE,
            "{GOLD}" => TextFormat::GOLD,
            "{GRAY}" => TextFormat::GRAY,
            "{DARK_GRAY}" => TextFormat::DARK_GRAY,
            "{BLUE}" => TextFormat::BLUE,
            "{GREEN}" => TextFormat::GREEN,
            "{AQUA}" => TextFormat::AQUA,
            "{RED}" => TextFormat::RED,
            "{PINK}" => TextFormat::LIGHT_PURPLE,
            "{YELLOW}" => TextFormat::YELLOW,
            "{WHITE}" => TextFormat::WHITE,
            "{ORANGE}" => "§6",
            # {BOLD} => "§l", {RESET} => "§r"
            "{BOLD}" => TextFormat::BOLD,
            "{RESET}" => TextFormat::RESET
        ];
        return str_replace(array_keys($replacements), $replacements, $score);
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getCps(Player $player): int{
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
     */
    public static function setCps(Player $player){
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
}