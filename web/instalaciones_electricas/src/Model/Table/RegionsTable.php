<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use ConstantesLimitDataTypes;

/**
 * Regions Model
 */
class RegionsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('regions');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsTo('Countries')
		->setForeignKey('id_country');

		$this->belongsToMany('Technologies', [
			'joinTable' => 'regions_technologies',
		])->setForeignKey('id_region');

		$this->hasMany('Arcs')
    	->setForeignKey([ 'id_region_1' ])
		->setForeignKey([ 'id_region_2' ]);

		$this->hasMany('Rangedemands')
    	->setForeignKey([ 'id_region' ]);
	}

	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('id_country');
		$validator->notEmpty('name');
		$validator->allowEmpty('dem_for');
		$validator->allowEmpty('ren_for');

		$validator->add('dem_for',[
			'dem_for'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);
		$validator->add('ren_for',[
			'ren_for'=>[
				'rule'=>[$this, 'id_decimal_7_4'],
			]
		]);

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

	public function search_list_reverse (){
		$query = $this->find('list', [
			'keyField' => 'name',
			'valueField' => 'id'
		])
		->toArray();

		return $query;
	}

	public function findRegionByName(Query $query, $name){
        return $query
			->select(['id' => 'Regions.id'])
			->where([
                'Region.name' => $name
            ]);
	}

	public function getQueryRegionsAndCountry ($filters){
		$query = $this->find('all');
        $query->select(['Countries.name']);
        $query->select(['Regions.id', 'Regions.name', 'Regions.dem_for', 'Regions.ren_for']);
        $query->join([
            'alias' => 'Countries',
            'table' => 'countries',
            'type' => 'INNER',
            'conditions' => 'Countries.id = Regions.id_country'
		]);
		$query->where($filters);
		
		return $query;
	}

	public function getRegionAndCountryByRegionId ($id_region){
		$query = $this->find();
        $query->select(['Regions.id', 'Regions.name', 'Regions.id_country', 'Regions.dem_for', 'Regions.ren_for']);
		$query->select(['Countries.name']);
        $query->join([
            'alias' => 'Countries',
            'table' => 'countries',
            'type' => 'INNER',
            'conditions' => 'Countries.id = Regions.id_country'
		]);
		$query->where([
			'Regions.id' => $id_region
		]);
		
		
		return $query->first()->toArray();
	}

	public function getTechnologiesByRegionId ($id_region){
		$query = $this->find('all');
		$query
			->select(['Regions.id', 'Regions.name'])
			->select(['Technology.id', 'Technology.name', 'Technology.renewable'])
			->select(['RegionTechnology.id_region', 'RegionTechnology.id_technology', 'RegionTechnology.power', 'RegionTechnology.cap_ava', 'RegionTechnology.gen_ava'])
			->where([
				'Regions.id' => $id_region
			])
			->order([
				'Technology.name' => 'ASC'
			])
        	->join([
				'RegionTechnology' => [
					'table' => 'regions_technologies',
					'type' => 'INNER',
					'conditions' => 'Regions.id = RegionTechnology.id_region'
				],
				'Technology' => [
					'table' => 'technologies',
					'type' => 'INNER',
					'conditions' => 'Technology.id = RegionTechnology.id_technology'
				]
			]);
			
		
		return $query->toArray();
	}

	public function getArcsByRegionId ($id_region){
		$query = $this->find('all');
		$query
			->select(['Regions.id', 'Regions.name'])
			->select(['Arcs.id', 'Arcs.id_region_1', 'Arcs.id_region_2', 'Arcs.distance'])
			->select(['Regions2.id', 'Regions2.name'])
			->select(['ArcsTypelines.id_arc', 'ArcsTypelines.id_typeline', 'ArcsTypelines.num_lines'])
			->select(['Typelines.id', 'Typelines.lin_cap', 'Typelines.tension'])
			->where([
				'Arcs.id_region_1' => $id_region
			])
			->order([
				'Arcs.distance' => 'ASC'
			])
        	->join([
				'Arcs' => [
					'table' => 'arcs',
					'type' => 'INNER',
					'conditions' => 'Arcs.id_region_1 = Regions.id'
				],
				'Regions2' => [
					'table' => 'regions',
					'type' => 'INNER',
					'conditions' => 'Regions2.id = Arcs.id_region_2'
				],
				'ArcsTypelines' => [
					'table' => 'arcs_typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypelines.id_arc = Arcs.id'
				],
				'Typelines' => [
					'table' => 'typelines',
					'type' => 'LEFT',
					'conditions' => 'ArcsTypelines.id_typeline = Typelines.id'
				],
			]);
		
		return $query->toArray();
	}


}
