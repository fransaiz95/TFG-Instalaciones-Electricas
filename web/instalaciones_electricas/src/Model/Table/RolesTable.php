<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use ConstantesLimitDataTypes;

class RolesTable extends Table
{

    public function initialize(array $config) {
		$this->table('roles');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->hasMany('Users')
		->setForeignKey('id_role');

    }
    
    public function search_list (){
		$query = $this->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])
		->toArray();

		return $query;
	}

}