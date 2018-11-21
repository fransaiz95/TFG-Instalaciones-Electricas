<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArcTypeline Entity.
 */
class ArcTypeline extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id' => true,
		'id_arc' => true,
		'id_typeline' => true,
		'num_lines' => true,
	];

}
