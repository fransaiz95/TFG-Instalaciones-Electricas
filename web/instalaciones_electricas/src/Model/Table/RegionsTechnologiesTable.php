<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegionsTechnology Model
 */
class RegionsTechnologiesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('regions_technologies');
		$this->displayField('power');
		$this->primaryKey(['id_region', 'id_technology']);

		$this->belongsTo('Regions')
		->setForeignKey('id_region');

		$this->belongsTo('Technologies')
		->setForeignKey('id_technology');
	}

	/**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('id_region');
		$validator->notEmpty('id_technology');
		$validator->allowEmpty('power');
		$validator->allowEmpty('cap_ava');

		$validator->add('power',[
			'power'=>[
				'rule'=>[$this, 'id_decimal_12_2'],
			]
		]);
		$validator->add('cap_ava',[
			'cap_ava'=>[
				'rule'=>[$this, 'id_decimal_12_2'],
			]
		]);

        return $validator;
	}

	// public function findRegionTechnologyByRegionAndTechnology(Query $query, $name){
	public function findRegionTechnologyByRegionAndTechnology($id_region, $id_technology){
		$query = $this->find('all');
        $query->select(['RegionsTechnologies.id_region', 'RegionsTechnologies.id_technology', 'RegionsTechnologies.power', 'RegionsTechnologies.cap_ava']);
		$query->where([
			'RegionsTechnologies.id_region' => $id_region,
			'RegionsTechnologies.id_technology' => $id_technology,
		]);

		return $query->toArray();
	}

	

}
