<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RangedemandsTable Table
 */
class RangedemandsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('rangedemands');
		$this->primaryKey(['id_region', 'start']);

		$this->belongsTo('Regions', [
			'foreignKey' => 'id_region',
		]);

		$this->addBehavior('Josegonzalez/Upload.Upload', [
            // You can configure as many upload fields as possible,
            // where the pattern is `field` => `config`
            //
            // Keep in mind that while this plugin does not have any limits in terms of
            // number of files uploaded per request, you should keep this down in order
            // to decrease the ability of your users to block other requests.
            'photo' => []
        ]);
	}

    public function getAllByYear($year){

        $query = $this->find('all');
		$query
			->select(['Rangedemands.id_region', 'Rangedemands.start', 'Rangedemands.end', 'Rangedemands.demand'])
			->where([
				"Rangedemands.start LIKE '%" . $year . "%'"
            ])
            ->order(['Rangedemands.start'])
            ->group(['Rangedemands.start']);
		
		return $query->toArray();

    }

    public function getNumberHoursByYear($year){
        $query = $this->find();
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(["year(start) = " => $year]);
        $query->group(["id_region"]);
        $query->order('count desc');
        $query->limit(1);

        return $query;
    }
}
