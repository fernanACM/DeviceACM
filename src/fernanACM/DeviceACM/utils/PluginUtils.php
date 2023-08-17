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

use fernanACM\DeviceACM\manager\DeviceManager;

class PluginUtils{

    /**
     * @param Player $player
     * @param string $score
     * @return string
     */
    public static function getDeviceCode(Player $player, string $score): string{
        $replacements = [
            "{LINE}" => "\n",
            "{NAME}" => $player->getName(),
            "{HEALTH}" => $player->getHealth(),
            "{MAX_HEALTH}" => $player->getMaxHealth(),
            "{FOOD}" => $player->getHungerManager()->getFood(),
            "{MAX_FOOD}" => $player->getHungerManager()->getMaxFood(),
            "{PING}" => $player->getNetworkSession()->getPing(),
            "{DEVICE}" => DeviceManager::getInstance()->getPlayerPlatform($player),
            "{WORLD}" => $player->getWorld()->getFolderName(),
            "{CPS}" => DeviceManager::getInstance()->getCps($player),
            "{REACH}" => DeviceManager::getInstance()->getReach($player),
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
        return strtr($score, $replacements);
    }
}