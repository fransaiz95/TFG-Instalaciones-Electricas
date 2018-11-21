<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fuels Model
 */
class TypelinesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('typelines');
		$this->displayField('lin_cap');
		$this->primaryKey('id');

		$this->belongsToMany('Arcs', [
			'joinTable' => 'arcs_typelines',
		])->setForeignKey('id_typeline');

		$this->hasMany('ArcsTypelines')
    	->setForeignKey([ 'id_typeline' ]);
	}

	public function search_list (){
		$query = $this->find('list', [
			'keyField' => 'id',
			'valueField' => 'lin_cap'
		])
		->toArray();

		return $query;
	}

}
