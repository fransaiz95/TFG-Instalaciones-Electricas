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
		$this->hasMany('Simulations')
		->setForeignKey('id_user');
	}

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', 'A name is required')
            ->notEmpty('surname', 'A surname is required')
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('id_role', 'A role is required')
            ->add('password', 'custom', [
                'rule' => [$this, 'checkCharacters'],
                'message' => 'The password must contain 1 number, 1 uppercase and 1 lowercase.'
            ])
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Passwords must be at least 8 characters long.',
                ]
            ])
            ->add('username',['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'That user already exists']]);
    }

    public function checkCharacters($password, array $context)
    {
        // number
        if (!preg_match("#[0-9]#", $password)) {
            return false;
        }
        // Uppercase
        if (!preg_match("#[A-Z]#", $password)) {
            return false;
        }
        // lowercase
        if (!preg_match("#[a-z]#", $password)) {
            return false;
        }
        // // special characters
        // if (!preg_match("#\W+#", $password) ) {
        //     return false;
        // }
        return true;
    }

    public function getQueryUsersAndRole ($filters){
		$query = $this->find('all');
        $query->select(['Roles.name']);
        $query->select(['Users.id', 'Users.name', 'Users.surname', 'Users.username', 'Users.id_role']);
        $query->join([
            'alias' => 'Roles',
            'table' => 'roles',
            'type' => 'INNER',
            'conditions' => 'Roles.id = Users.id_role'
		]);
		$query->where($filters);
		
		return $query;
	}

}