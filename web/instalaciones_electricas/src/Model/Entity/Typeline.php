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
		'new_line_cos' => true,
		'man_lin_cos' => true,
		'flo_cos' => true,
		'new_lim_emp' => true,
		'man_lim_emp' => true,
		'flo_emp' => true,
		'eff_lin' => true,
	];

}
