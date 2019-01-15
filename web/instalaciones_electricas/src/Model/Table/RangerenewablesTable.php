<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegionsTechnology Model
 */
class RangerenewablesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('rangerenewables');
		$this->primaryKey(['id_region', 'id_technology', 'start']);

		$this->belongsTo('Regions', [
			'foreignKey' => 'id_region',
		]);
		$this->belongsTo('Technologies', [
			'foreignKey' => 'id_technology',
		]);

		// $this->belongsTo('Countries', [
		// 	'foreignKey' => 'id_country',
		// ]);
	}

}
