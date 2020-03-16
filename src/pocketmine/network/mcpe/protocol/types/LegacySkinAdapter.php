<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol\types;

use pocketmine\entity\Skin;

class LegacySkinAdapter implements SkinAdapter{

	public function toSkinData(Skin $skin) : SkinData{
		return new SkinData(
			$skin->getSkinId(),
			$skin->getResourcePatch(),
			$skin->getSkinImage(),
			$skin->getAnimations(),
			$skin->getCape()->getImage(),
			$skin->getGeometryData(),
			$skin->getAnimationData(),
			$skin->isPremium(),
			$skin->isPersona(),
			$skin->getCape()->isOnClassicSkin(),
			$skin->getCape()->getId()
		);
	}

	public function fromSkinData(SkinData $data) : Skin{
		return (new Skin(
			$data->getSkinId(),
			"",
			"",
			$data->getResourcePatch(),
			$data->getGeometryData()
		))->setSkinImage($data->getSkinImage())
			->setCape(new Cape($data->getCapeId(), $data->getCapeImage(), $data->isPersonaCapeOnClassic()))
			->setAnimations($data->getAnimations())
			->setAnimationData($data->getAnimationData())
			->setPremium($data->isPremium())
			->setPersona($data->isPersona());
	}
}
