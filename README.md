[![](https://poggit.pmmp.io/shield.state/DeviceACM)](https://poggit.pmmp.io/p/DeviceACM)

[![](https://poggit.pmmp.io/shield.api/DeviceACM)](https://poggit.pmmp.io/p/DeviceACM)

# DeviceACM

**Simple tag to see your health, hunger, cps, connection, faction and device you use. The best DeviceTag for PocketMine-PM 5.0 servers.**

![1665729976547](https://user-images.githubusercontent.com/83558341/195784419-7efde11a-f0f0-4dc2-ad3c-69616cbfb611.png)

<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 💡 Implementations
* [X] Configuration
* [x] Faction support
* [x] ScoreTag customization
* [x] PopupTag customization
* [x] DeviceTag and PopupTag per worlds
* [x] Platform 
* [x] Keys in config.yml

### 💾 Config 
```yaml
#  ____    _____  __     __  ___    ____   _____      _       ____   __  __ 
# |  _ \  | ____| \ \   / / |_ _|  / ___| | ____|    / \     / ___| |  \/  |
# | | | | |  _|    \ \ / /   | |  | |     |  _|     / _ \   | |     | |\/| |
# | |_| | | |___    \ V /    | |  | |___  | |___   / ___ \  | |___  | |  | |
# |____/  |_____|    \_/    |___|  \____| |_____| /_/   \_\  \____| |_|  |_|
#       by fernanACM
# A simple and customizable DeviceTag via 'config.yml'. Shows your health, hunger, 
# connection, device, cps, faction (ONLY IF YOU ACTIVATE SUPPORT) and more. 
# The best DeviceTag for Pocketmine 5.0 servers.

# VERSION CONFIG
config-version: "3.0.0"

# ======(KEYS)======
# PLUGIN:
# {NAME} => player name
# {HEALTH} => player life
# {MAX_HEALTH} => player max life
# {FOOD} => player hunger
# {MAX_FOOD} => player max hunger
# {PING} => player connection
# {DEVICE} => player device
# {CPS} => player cps
# {WORLD} => world name
# {REACH} => player reach

# POPUP:
# {VICTIM_NAME} => victm name
# {VICTIM_HEALTH} => victm life
# {VICTIM_MAX_HEALTH} => victm max life
# {VICTIM_FOOD} => victm hunger
# {VICTIM_MAX_FOOD} => victm max hunger
# {VICTIM_PING} => victm connection
# {VICTIM_DEVICE} => victm device
# {VICTIM_CPS} => victm cps
# {VICTIM_WORLD} => world name
# {VICTIM_REACH} => victm reach

# FACTION SUPPORT:
# {FACTION} => faction name
# {FACTION_RANK} => faction rank
# {FACTION_POWER} => faction power

# EXTRAS:
# "{LINE}" => "\n",
# - COLORS
#  "&" => §,
# "{BLACK}" => TextFormat::BLACK,
# "{DARK_BLUE}" => TextFormat::DARK_BLUE,
# "{DARK_GREEN}" => TextFormat::DARK_GREEN,
# "{CYAN}" => TextFormat::DARK_AQUA,
# "{DARK_RED}" => TextFormat::DARK_RED,
# "{PURPLE}" => TextFormat::DARK_PURPLE,
# "{GOLD}" => TextFormat::GOLD,
# "{GRAY}" => TextFormat::GRAY,
# "{DARK_GRAY}" => TextFormat::DARK_GRAY,
# "{BLUE}" => TextFormat::BLUE,
# "{GREEN}" => TextFormat::GREEN,
# "{AQUA}" => TextFormat::AQUA,
# "{RED}" => TextFormat::RED,
# "{PINK}" => TextFormat::LIGHT_PURPLE,
# "{YELLOW}" => TextFormat::YELLOW,
# "{WHITE}" => TextFormat::WHITE,
# "{ORANGE}" => "§6"
# "{BOLD}" => TextFormat::BOLD,
# "{RESET}" => TextFormat::RESET

# ==(CONFIGURATION)==
Settings:
  # ==(WORLD MANAGER)==
  # Enable and disable DeviceACM or PopupTag for worlds you 
  # add to "whitelist" or "blacklist" modes
  WorldManager:
    # Valid modes:
    # - whitelist
    # - blacklist
    mode: whitelist
    # ==(DEVICE TAG)==
    Device:
      # Add the names of worlds that are in the whitelist
      worlds-whitelist:
        - "world"
        - "world-2"
        - "ACM"
      # Add the names of worlds that are in the blacklist
      worlds-blacklist:
        - "MinePvP"
        - "ZonePvP"
    # ==(POUPUP)==
    Popup:
      # Add the names of worlds that are in the whitelist
      worlds-whitelist:
        - "world"
        - "world-2"
        - "ACM"
      # Add the names of worlds that are in the blacklist
      worlds-blacklist:
        - "MinePvP"
        - "ZonePvP"
# ==(FACTION SUPPORT)==
# Use "true" or "false" to enable/disable this option
FactionSupport: true

Faction:
  # have no faction
  no-faction: "§5N/A"
  # Have no faction rank
  no-faction-rank: "§5N/A"

# ==(DEVICE TAG)==
Devicetag:
  line: 
    - "&c♥ {HEALTH}&f |  {FOOD}"
    - "&aPing: &f{PING} |&6 CPS:&f {CPS} |&b {DEVICE}"
    - "&cFaction: &a{FACTION}&f | &cPower:&a {FACTION_POWER}&f | &cRank:&a {FACTION_RANK}"
# ==(POPUP TAG)==
Popuptag:
  # Use "true" or "false" to enable/disable this option
  enabled: true
  # Valid modes:
    # - popup
    # - actionbar
    # - tip
  mode: popup
  line:
    - "&bVictim:&a {VICTIM_NAME}"
    - "&bVictim ping:&e {VICTIM_PING}"
    - "&bYour cps:&6 {CPS}&f |&b Victim cps:&6 {VICTIM_CPS}"
    - "&bYour reach:&e {REACH}&f |&b Victim reach:&e {VICTIM_REACH}"
# ==(PLATAFORM TAG)==
Platform:
  Android: "Android"
  iOS: "iOS"
  macOS: "macOS"
  FireOS: "Amazon"
  GearVR: "Gear VR"
  Hololens: "Hololens"
  Windows10: "Windows 10"
  Windows7: "Win32"
  Dedicated: "Dedicated"
  TVOS: "TV OS"
  PlayStation: "PlayStation"
  NintendoSwitch: "Nintendo"
  Xbox: "Xbox"
  WindowsPhone: "Windows Phone"
  Unknown: "Unknown"
```
### 🛠 Faction support
| Author | Plugin |
| -------|---------|
| DaDevPig | [PiggyFactions](https://github.com/DaPigGuy/PiggyFactions) |
| AyzrixYTB | [SimpleFaction](https://github.com/AyzrixYTB/SimpleFaction) |
| Wertzui123 | [BedrockClans](https://github.com/Wertzui123/BedrockClans/tree/master/) |
| ShockedPlot7560 | [FactionMaster](https://github.com/FactionMaster/FactionMaster) |
| rxduz | AdvancedFactions |
***

### 📞 Contact
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### ✔ Credits
| Authors | Github | Lib |
|---------|--------|-----|
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyUpdateChecker](https://github.com/DaPigGuy/libPiggyUpdateChecker) |
****
