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
		$this->primaryKey('id');

		$this->belongsTo('Regions')
		->setForeignKey('id_region_1')
		->setForeignKey('id_region_2');
	}

	public function getArcsWithRegions ($id_arc){
		$query = $this->find('all');
		$query
			->select(['Regions.id', 'Regions.name'])
			->select(['Regions2.id', 'Regions2.name'])
			->select(['Arcs.id_region_1', 'Arcs.id_region_2', 'Arcs.distance'])
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
			]);
			
		
		return $query->toArray();
	}

}
