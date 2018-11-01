<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArcsTypelines Model
 */
class ArcsTypelines extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('arcs_typelines');
		$this->primaryKey(['id_arc', 'id_typeline']);

		// $this->belongsTo('Countries', [
		// 	'foreignKey' => 'id_country',
		// ]);
	}

}
