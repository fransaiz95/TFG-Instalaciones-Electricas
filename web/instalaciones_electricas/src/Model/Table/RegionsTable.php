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

		$this->belongsTo('Countries', [
			'foreignKey' => 'id_country',
		]);
	}

	public function findRegionByName(Query $query, $name)
    {
        return $query
			->select(['id' => 'Regions.id'])
			->where([
                'Region.name' => $name
            ]);
    }

}
