<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegionTechnology Entity.
 */
class Rangerenowable extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id_region' => true,
		'id_technology' => true,
		'start' => true,
		'gen_ava' => true,
		'end' => true,
	];

}
