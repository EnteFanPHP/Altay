<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\entity\EntityFactory;
use pocketmine\entity\object\FallingBlock;
use pocketmine\math\Facing;

abstract class Fallable extends Solid{

	public function onNearbyBlockChange() : void{
		$down = $this->getSide(Facing::DOWN);
		if($down->getId() === self::AIR or $down instanceof Liquid or $down instanceof Fire){
			$this->level->setBlock($this, BlockFactory::get(Block::AIR));

			$nbt = EntityFactory::createBaseNBT($this->add(0.5, 0, 0.5));
			$nbt->setInt("TileID", $this->getId());
			$nbt->setByte("Data", $this->getDamage());

			/** @var FallingBlock $fall */
			$fall = EntityFactory::create(FallingBlock::class, $this->getLevel(), $nbt);
			$fall->spawnToAll();
		}
	}

	/**
	 * @return null|Block
	 */
	public function tickFalling() : ?Block{
		return null;
	}
}