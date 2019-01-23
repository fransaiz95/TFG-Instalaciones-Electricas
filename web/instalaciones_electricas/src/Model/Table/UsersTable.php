<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use ConstantesLimitDataTypes;

class UsersTable extends Table
{

    public function initialize(array $config) {
		$this->table('users');
		$this->displayField('username');
		$this->primaryKey('id');

		$this->belongsTo('Roles')
		->setForeignKey('id_role');

	}

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', 'A name is required')
            ->notEmpty('surname', 'A surname is required')
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('id_role', 'A role is required');
    }

}