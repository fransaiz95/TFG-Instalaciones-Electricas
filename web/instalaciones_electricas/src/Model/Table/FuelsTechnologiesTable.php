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

}
