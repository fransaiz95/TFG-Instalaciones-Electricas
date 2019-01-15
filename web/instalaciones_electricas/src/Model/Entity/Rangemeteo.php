<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegionTechnology Entity.
 */
class Rangedemand extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id_region' => true,
		'start' => true,
		'end' => true,
		'temp' => true,
		'wind' => true,
		'hum' => true,
	];

}
