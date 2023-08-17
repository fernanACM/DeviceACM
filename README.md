[![](https://poggit.pmmp.io/shield.state/DeviceACM)](https://poggit.pmmp.io/p/DeviceACM)

[![](https://poggit.pmmp.io/shield.api/DeviceACM)](https://poggit.pmmp.io/p/DeviceACM)

# DeviceACM

**A simple and customizable tag via 'config.yml'. Shows your health, hunger, connection, device, cps and faction (ONLY IF YOU ACTIVATE SUPPORT). The best tag for Pocketmine 5.0 servers.**

![1665729976547](https://user-images.githubusercontent.com/83558341/195784419-7efde11a-f0f0-4dc2-ad3c-69616cbfb611.png)

<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 💡 Implementations
* [X] Configuration
* [x] Faction support
* [x] ScoreTag customization.
* [x] Platform 
* [x] Keys in config.yml.

### 💾 Config 
```yaml
#  ____    _____  __     __  ___    ____   _____      _       ____   __  __ 
# |  _ \  | ____| \ \   / / |_ _|  / ___| | ____|    / \     / ___| |  \/  |
# | | | | |  _|    \ \ / /   | |  | |     |  _|     / _ \   | |     | |\/| |
# | |_| | | |___    \ V /    | |  | |___  | |___   / ___ \  | |___  | |  | |
# |____/  |_____|    \_/    |___|  \____| |_____| /_/   \_\  \____| |_|  |_|
#       by fernanACM
# A simple and customizable tag via 'config.yml'. Shows your health, hunger, 
# connection, device, cps and faction (ONLY IF YOU ACTIVATE SUPPORT). 
# The best tag for Pocketmine 4.0 servers.

# VERSION CONFIG
config-version: "2.0.0"

# ======(KEYS)======
# PLUGIN:
# {HEALTH} => player life
# {MAX_HEALTH} => player max life
# {FOOD} => player's hunger
# {MAX_FOOD} => player's max hunger
# {PING} => player connection
# {DEVICE} => player device
# {CPS} => player cps
# {WORLD} => world name

# FACTION SUPPORT
# {FACTION} => faction name
# {FACTION_RANK} => faction rank
# {FACTION_POWER} => faction power

# EXTRAS:
# "{LINE}" => "\n",
# - COLORS
#  & => §,
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

# ======(FACTION SUPPORT)======
# Use "true" or "false" to enable/disable this option
FactionSupport: true

Faction:
  # have no faction
  no-faction: "§5NO FACTION"
  # Have no faction rank
  no-faction-rank: "§5NO RANK"

# ======(DEVICE TAG)======
Devicetag:
  line: 
    - "&c♥ {HEALTH}&f |  {FOOD}"
    - "&aPing: &f{PING} |&6 CPS:&f {CPS} |&b {DEVICE}"
    - "&cFaction: &a{FACTION}&f | &cPower:&a {FACTION_POWER}&f | &cRank:&a {FACTION_RANK}"
# ======(PLATAFORM TAG)======
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
