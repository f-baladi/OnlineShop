<?php


namespace App\Repositories;


use App\Models\Color;
use App\Repositories\Interfaces\ColorRepositoryInterface;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Color $model
     */
    public function __construct(Color $model)
    {
        parent::__construct($model);
    }
}
