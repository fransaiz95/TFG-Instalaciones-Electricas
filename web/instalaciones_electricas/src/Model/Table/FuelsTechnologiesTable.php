<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FuelsTechnologies Model
 */
class FuelsTechnologiesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('fuels_technologies');
		$this->primaryKey(['id_fuel', 'id_technology']);

		$this->belongsTo('Fuels')
		->setForeignKey('id_fuel');

		$this->belongsTo('Technologies')
		->setForeignKey('id_technology');
	}

	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('id_region');
		$validator->notEmpty('id_technology');
		$validator->allowEmpty('power');
		$validator->allowEmpty('cap_ava');

		$validator->add('power',[
			'power'=>[
				'rule'=>[$this, 'id_decimal_12_2'],
			]
		]);
		$validator->add('perc_con',[
			'perc_con'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);
		$validator->add('fue_con',[
			'fue_con'=>[
				'rule'=>[$this, 'id_decimal_5_2'],
			]
		]);

		$validator->add('id_technology',[
			'id_technology'=>[
				'rule'=>[$this, 'fuel_technology_add'],
			]
		]);

        return $validator;
	}

}