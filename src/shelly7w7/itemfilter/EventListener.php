<?php
declare(strict_types=1);

namespace shelly7w7\itemfilter;

use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

class EventListener implements Listener{

	/** @var Main $plugin */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}

	public function onInventoryPickupItem(InventoryPickupItemEvent $event): void{
		foreach($event->getViewers() as $player){
			if($player instanceof Player){
				if($this->plugin->hasFilterEnabled()){
					$event->setCancelled();
					$config = $this->plugin->getConfig();
					if($config->get("toggle-popup") === true){
						$player->sendActionBarMessage($config->get("popup-message"));
					}
				}
			}
		}
	}
}