<?php

namespace App\Repositories;

use App\Models\Participant;
use App\Repositories\BaseRepository;

/**
 * Class ParticipantRepository
 * @package App\Repositories
 * @version February 6, 2022, 2:50 am UTC
*/

class ParticipantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'uuid',
        'pref',
        'district',
        'dan',
        'dan_number',
        'role',
        'email',
        'phone',
        'seat_number'
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
        return Participant::class;
    }
}
