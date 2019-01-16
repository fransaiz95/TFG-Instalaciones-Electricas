<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegionsTechnology Model
 */
class RangerenewablesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('rangerenewables');
		$this->primaryKey(['id_region', 'id_technology', 'start']);

		$this->belongsTo('Regions', [
			'foreignKey' => 'id_region',
		]);
		$this->belongsTo('Technologies', [
			'foreignKey' => 'id_technology',
		]);

		// $this->belongsTo('Countries', [
		// 	'foreignKey' => 'id_country',
		// ]);
	}

	public function getAllByYearAndTechnology($year, $id_technology){

        $query = $this->find('all');
		$query
			->select(['Rangerenewables.id_region', 'Rangerenewables.id_technology', 'Rangerenewables.start', 'Rangerenewables.end', 'Rangerenewables.gen_ava'])
			->where([
				"Rangerenewables.start LIKE '%" . $year . "%'",
				'Rangerenewables.id_technology = ' => $id_technology
            ])
            ->order(['Rangerenewables.start'])
            ->group(['Rangerenewables.start']);
		
		return $query->toArray();

    }

}
