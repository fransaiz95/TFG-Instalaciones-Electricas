<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArcsTypelines Model
 */
class ArcsTypelinesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('arcs_typelines');
		$this->primaryKey(['id_arc', 'id_typeline']);

		$this->belongsTo('Arcs')
		->setForeignKey('id_arc');

		$this->belongsTo('Typelines')
		->setForeignKey('id_typeline');
	}

	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('id_arc');
		$validator->notEmpty('id_typeline');
		$validator->notEmpty('num_lines');

		$validator->add('num_lines',[
			'num_lines'=>[
				'rule'=>[$this, 'id_decimal_3_0'],
			]
		]);

        return $validator;
	}


}
