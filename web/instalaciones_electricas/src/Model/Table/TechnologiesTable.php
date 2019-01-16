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
		])->setForeignKey('id_technology');
		
		$this->belongsToMany('Fuels', [
			'joinTable' => 'fuels_technologies',
		])->setForeignKey('id_technology');
	}

	
	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
		$validator->notEmpty('name');
		$validator->allowEmpty('wat_wit');
		$validator->allowEmpty('genco_pri');
		$validator->allowEmpty('cap');
		$validator->allowEmpty('new_cap_cos');
		$validator->allowEmpty('man_cos');
		$validator->allowEmpty('man_cos_new_cap');
		$validator->allowEmpty('gen_cos');
		$validator->allowEmpty('gen_cos_new_cap');
		$validator->allowEmpty('life_time');
		$validator->allowEmpty('ghg_emi');
		$validator->allowEmpty('inv_cap_emp');
		$validator->allowEmpty('man_cap_emp');
		$validator->allowEmpty('dec_cam_emp');
		$validator->allowEmpty('om_cap_emp');
		$validator->allowEmpty('om_cap_emp');
		$validator->allowEmpty('fue_cap_emp');
		$validator->allowEmpty('wat_con');

		$validator->add('wat_wit',[
			'wat_wit'=>[
				'rule'=>[$this, 'id_decimal_15_0'],
			]
		]);
		$validator->add('genco_pri',[
			'genco_pri'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);
		$validator->add('cap',[
			'cap'=>[
				'rule'=>[$this, 'id_decimal_10_0'],
			]
		]);
		$validator->add('new_cap_cos',[
			'new_cap_cos'=>[
				'rule'=>[$this, 'id_decimal_15_0'],
			]
		]);
		$validator->add('man_cos',[
			'man_cos'=>[
				'rule'=>[$this, 'id_decimal_12_2'],
			]
		]);
		$validator->add('man_cos_new_cap',[
			'man_cos_new_cap'=>[
				'rule'=>[$this, 'id_decimal_10_0'],
			]
		]);
		$validator->add('gen_cos',[
			'gen_cos'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);
		$validator->add('gen_cos_new_cap',[
			'gen_cos_new_cap'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);
		$validator->add('life_time',[
			'life_time'=>[
				'rule'=>[$this, 'id_decimal_3_0'],
			]
		]);
		$validator->add('ghg_emi',[
			'ghg_emi'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);
		$validator->add('inv_cap_emp',[
			'inv_cap_emp'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('man_cap_emp',[
			'man_cap_emp'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('dec_cam_emp',[
			'dec_cam_emp'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('om_cap_emp',[
			'om_cap_emp'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('fue_cap_emp',[
			'fue_cap_emp'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('wat_con',[
			'wat_con'=>[
				'rule'=>[$this, 'id_decimal_15_0'],
			]
		]);

        return $validator;
	}

	public function getQueryTechnologies ($filters){
		$query = $this->find('all');
		$query->select(['Technologies.id', 'Technologies.name', 'Technologies.renewable', 'Technologies.wat_wit', 'Technologies.genco_pri', 
		'Technologies.cap', 'Technologies.new_cap_cos', 'Technologies.man_cos', 'Technologies.man_cos_new_cap', 'Technologies.gen_cos', 
		'Technologies.gen_cos_new_cap', 'Technologies.life_time', 'Technologies.ghg_emi', 'Technologies.inv_cap_emp', 
		'Technologies.man_cap_emp', 'Technologies.dec_cam_emp', 'Technologies.om_cap_emp', 'Technologies.fue_cap_emp', 'Technologies.wat_con']);
		$query->where('Technologies.renewable = 1');
		
		return $query;	
	}

}
