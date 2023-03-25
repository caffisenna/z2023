<?php

namespace App\Repositories;

use App\Models\Staffinfo;
use App\Repositories\BaseRepository;

/**
 * Class StaffinfoRepository
 * @package App\Repositories
 * @version October 7, 2022, 10:00 pm JST
*/

class StaffinfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'furigana',
        'gender',
        'bs_id',
        'prefecture',
        'district',
        'dan',
        'role',
        'cell_phone',
        'zip',
        'address',
        'team'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Staffinfo::class;
    }
}
