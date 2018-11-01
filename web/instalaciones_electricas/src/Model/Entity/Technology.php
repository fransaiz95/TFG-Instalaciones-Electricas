<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Technology Entity.
 */
class Technology extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
		'id' => true,
		'name' => true,
		'renowable' => true,
		'wat_wit' => true,
		'genco_pri' => true,
		'cap' => true,
		'new_cap_cos' => true,
		'man_cos' => true,
		'man_cos_new_cap' => true,
		'gen_cos' => true,
		'gen_cos_new_cap' => true,
		'life_time' => true,
		'ghg_emi' => true,
		'inv_cap_emp' => true,
		'man_cap_emp' => true,
		'dec_cam_emp' => true,
		'om_cap_emp' => true,
		'fue_cap_emp' => true,
		'wat_con' => true,
	];

}
