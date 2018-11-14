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
		]);
		
		$this->belongsToMany('Fuels', [
			'joinTable' => 'fuels_technologies',
		]);
	}

}
