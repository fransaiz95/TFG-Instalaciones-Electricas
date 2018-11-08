<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
            ->notEmpty('id_country');


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

	public function findRegionByName(Query $query, $name){
        return $query
			->select(['id' => 'Regions.id'])
			->where([
                'Region.name' => $name
            ]);
	}
	
	public function getQueryRegionsAndCountry (){
		$query = $this->find('all');
        $query->select(['Regions.id', 'Regions.name', 'Regions.dem_for', 'Regions.ren_for']);
        $query->select(['Countries.name']);
        $query->join([
            'alias' => 'Countries',
            'table' => 'countries',
            'type' => 'INNER',
            'conditions' => 'Countries.id = Regions.id_country'
		]);
		$query->order([
			'Regions.name' => 'ASC'
		]);
		
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
			->select(['Technology.id', 'Technology.name', 'Technology.renowable'])
			->select(['RegionTechnology.id_region', 'RegionTechnology.id_technology', 'RegionTechnology.power', 'RegionTechnology.cap_ava'])
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
				]
			]);
		
		return $query->toArray();
	}


}
