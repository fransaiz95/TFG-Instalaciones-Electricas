<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Arc Model
 */
class ArcsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('arcs');
		$this->primaryKey('id');

		// $this->belongsTo('Countries', [
		// 	'foreignKey' => 'id_country',
		// ]);
	}

}
