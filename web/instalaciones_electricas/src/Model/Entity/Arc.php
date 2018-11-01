<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Arc Entity.
 */
class Arc extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id' => true,
		'id_region_1' => true,
		'id_region_2' => true,
		'distance' => true,
	];

}
