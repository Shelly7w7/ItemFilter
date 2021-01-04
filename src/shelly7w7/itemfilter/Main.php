<?php

declare(strict_types=1);

namespace shelly7w7\itemfilter;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{

	/** @var Config $config */
	protected $config;
	/** @var self $instance */
	protected static $instance;

	/** @Var bool */
	private $filter = false;

	public function onEnable(): void
	{
		self::$instance = $this;
		$this->getServer()->getCommandMap()->register("itemfilter", new ItemFilterCommand($this));
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

		$config = $this->getConfig();
		$config->save();
	}

	public static function getInstance(): self
	{
		return self::$instance;
	}

	/**
	 * @return bool
	 */
	public function hasFilterEnabled() : bool{
		return $this->filter;
	}

	public function toggleFilter() : void{
		$this->filter = !$this->filter;
	}
}