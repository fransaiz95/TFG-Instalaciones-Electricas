<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Technologies Model
 */
class TechnologiesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('technologies');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsToMany('Regions', [
            'joinTable' => 'regions_technologies',
		])->setForeignKey('id_technology');;
		
		$this->belongsToMany('Fuels', [
			'joinTable' => 'fuels_technologies',
		])->setForeignKey('id_technology');
	}

	public function getQueryTechnologies ($filters){
		$query = $this->find('all');
		$query->select(['Technologies.id', 'Technologies.name', 'Technologies.renowable', 'Technologies.wat_wit', 'Technologies.genco_pri', 
		'Technologies.cap', 'Technologies.new_cap_cos', 'Technologies.man_cos', 'Technologies.man_cos_new_cap', 'Technologies.gen_cos', 
		'Technologies.gen_cos_new_cap', 'Technologies.life_time', 'Technologies.ghg_emi', 'Technologies.inv_cap_emp', 
		'Technologies.man_cap_emp', 'Technologies.dec_cam_emp', 'Technologies.om_cap_emp', 'Technologies.fue_cap_emp', 'Technologies.wat_con']);
		$query->where($filters);
		
		return $query;	
	}

}
