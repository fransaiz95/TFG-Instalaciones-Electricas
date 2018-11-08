<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 */
class CountriesTable extends Table {

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */

	public function initialize(array $config) {
		$this->table('countries');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->hasMany('Regions')
    	->setForeignKey([ 'id_country' ]);
	
	}

	
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name');


			debug($validator);Exit;
        return $validator;
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