<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use ConstantesLimitDataTypes;

class SimulationsTable extends Table
{

    public function initialize(array $config) {
		$this->table('simulations');
		$this->displayField('simulation_name');
		$this->primaryKey('id');

		$this->belongsTo('Users')
		->setForeignKey('id_user');

	}

    // public function validationDefault(Validator $validator)
    // {
    //     return $validator
    //         ->notEmpty('name', 'A name is required')
    //         ->notEmpty('surname', 'A surname is required')
    //         ->notEmpty('username', 'A username is required')
    //         ->notEmpty('password', 'A password is required')
    //         ->notEmpty('id_role', 'A role is required');
    // }


    public function getQuerySimulations($filters){
		$query = $this->find('all');
        $query->select(['Users.name','Users.surname']);
        $query->select(['Simulations.id', 'Simulations.id_user', 'Simulations.simulation_name', 'Simulations.creation_date', 'Simulations.file']);
        $query->join([
            'alias' => 'Users',
            'table' => 'users',
            'type' => 'INNER',
            'conditions' => 'Users.id = Simulations.id_user'
		]);
		$query->where($filters);
		
		return $query;
	}

}