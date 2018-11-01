<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FuelTechnology Entity.
 */
class FuelTechnology extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id_fuel' => true,
		'id_technology' => true,
		'power' => true,
		'perc_con' => true,
		'fue_con' => true,
	];

}
