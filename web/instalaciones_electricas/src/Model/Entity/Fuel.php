<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fuel Entity.
 */
class Fuel extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id' => true,
		'name' => true,
		'fue_cos' => true,
		'production' => true,
	];

}
