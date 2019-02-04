<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Typeline Entity.
 */
class Typeline extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id' => true,
		'lin_cap' => true,
		'tension' => true,
		'new_lin_cos' => true,
		'man_lin_cos' => true,
		'flo_cos' => true,
		'eff_lin_bas' => true,
	];

}
