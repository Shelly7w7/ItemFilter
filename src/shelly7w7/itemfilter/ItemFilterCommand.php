<?php
declare(strict_types=1);

namespace shelly7w7\itemfilter;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ItemFilterCommand extends Command implements PluginIdentifiableCommand{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		parent::__construct("itemfilter", "Turn on/off item filter.", "/itemfilter", ["filter"]);
		$this->setPermission("healthtag.configure");
		$this->plugin = $plugin;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): void{
		if (!$this->testPermissionSilent($sender)) {
			$sender->sendMessage(TextFormat::RED . "You do not have permission to use this command");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Use command in-game");

			return;
		}
		$this->plugin->toggleFilter();
		$sender->sendMessage(TextFormat::RED . "You have " . TextFormat::YELLOW . ($this->plugin->hasFilterEnabled() ? "enabled" : "disabled") . TextFormat::RED . " item filter.");

	}

	/**
	 * @return Main|Plugin $plugin
	 */
	public function getPlugin(): Plugin{
		return $this->plugin;
	}
}
