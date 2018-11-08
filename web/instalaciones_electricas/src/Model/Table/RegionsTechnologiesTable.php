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
