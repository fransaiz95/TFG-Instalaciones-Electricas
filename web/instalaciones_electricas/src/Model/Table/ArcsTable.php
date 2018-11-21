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
		$this->displayField('id_region_1');
		$this->primaryKey('id');

		$this->belongsTo('Regions')
		->setForeignKey('id_region_1')
		->setForeignKey('id_region_2');

		$this->belongsToMany('Typelines', [
			'joinTable' => 'arcs_typelines',
		])->setForeignKey('id_arc');

		$this->hasMany('ArcsTypelines')
    	->setForeignKey([ 'id_arc' ]);

	}

	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('id_region_1');
		$validator->notEmpty('id_region_2');
		$validator->notEmpty('distance');

		$validator->add('distance',[
			'distance'=>[
				'rule'=>[$this, 'id_decimal_5_0'],
			]
		]);

        return $validator;
	}

	public function getQueryArcsWithRegions ($filters){
		$query = $this->find('all');
        $query->select(['Arcs.id', 'Arcs.id_region_1', 'Arcs.id_region_2', 'Arcs.distance']);
        $query->select(['Regions.id', 'Regions.name']);
		$query->select(['Regions2.id', 'Regions2.name']);
		$query->select(['ArcsTypelines.num_lines']);
		$query->where($filters);
		$query->join([
			'Regions' => [
				'table' => 'regions',
				'type' => 'INNER',
				'conditions' => 'Regions.id = Arcs.id_region_1'
			],
			'Regions2' => [
				'table' => 'regions',
				'type' => 'INNER',
				'conditions' => 'Regions2.id = Arcs.id_region_2'
			],
			'ArcsTypelines' => [
				'table' => 'arcs_typelines',
				'type' => 'LEFT',
				'conditions' => 'ArcsTypeLines.id_arc = Arcs.id'
			],
		]);
		
		return $query;	
	}

	public function getArcsWithRegions ($id_arc){
		$query = $this->find('all');
		$query
			->select(['Regions.id', 'Regions.name'])
			->select(['Regions2.id', 'Regions2.name'])
			->select(['Arcs.id', 'Arcs.id_region_1', 'Arcs.id_region_2', 'Arcs.distance'])
			->where([
				'Arcs.id' => $id_arc
			])
			->select(['ArcsTypelines.id_arc', 'ArcsTypelines.id_typeline', 'ArcsTypelines.num_lines'])
			->select(['Typelines.id', 'Typelines.lin_cap', 'Typelines.new_line_cos', 'Typelines.man_lin_cos', 'Typelines.flo_cos', 
					  'Typelines.new_lim_emp', 'Typelines.man_lim_emp', 'Typelines.flo_emp', 'Typelines.eff_lin'
					])
        	->join([
				'Regions' => [
					'table' => 'regions',
					'type' => 'INNER',
					'conditions' => 'Regions.id = Arcs.id_region_1'
				],
				'Regions2' => [
					'table' => 'regions',
					'type' => 'INNER',
					'conditions' => 'Regions2.id = Arcs.id_region_2'
				],
				'ArcsTypelines' => [
					'table' => 'arcs_typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypeLines.id_arc = Arcs.id'
				],
				'Typelines' => [
					'table' => 'typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypeLines.id_typeline = Typelines.id'
				],
			]);
			
		
		return $query->first();
	}

	public function getArcsWithRegionsAndTypeLine($id_arc){
		$query = $this->find('all');
		$query
			->select(['Regions.id', 'Regions.name'])
			->select(['Regions2.id', 'Regions2.name'])
			->select(['Arcs.id_region_1', 'Arcs.id_region_2', 'Arcs.distance'])
			->select(['ArcsTypelines.num_lines'])
			->select(['Typelines.id', 'Typelines.lin_cap', 'Typelines.new_line_cos', 'Typelines.man_lin_cos', 'Typelines.flo_cos', 
					  'Typelines.new_lim_emp', 'Typelines.man_lim_emp', 'Typelines.flo_emp', 'Typelines.eff_lin'
					])
			->where([
				'Arcs.id' => $id_arc
			])
        	->join([
				'Regions' => [
					'table' => 'regions',
					'type' => 'INNER',
					'conditions' => 'Regions.id = Arcs.id_region_1'
				],
				'Regions2' => [
					'table' => 'regions',
					'type' => 'INNER',
					'conditions' => 'Regions2.id = Arcs.id_region_2'
				],
				'ArcsTypelines' => [
					'table' => 'arcs_typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypeLines.id_arc = Arcs.id'
				],
				'Typelines' => [
					'table' => 'typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypeLines.id_typeline = Typelines.id'
				],
			]);
			
		
		return $query->first()->toArray();
	}

}
