<?php

namespace App\Repositories;

use App\Models\add_user;
use App\Repositories\BaseRepository;

/**
 * Class add_userRepository
 * @package App\Repositories
 * @version April 28, 2023, 10:24 pm JST
*/

class add_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'role',
        'password'
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
        return add_user::class;
    }
}
