<?php


namespace App\Repositories;


use App\Models\Warranty;
use App\Repositories\Interfaces\WarrantyRepositoryInterface;

class WarrantyRepository extends BaseRepository implements WarrantyRepositoryInterface
{
    public function __construct(Warranty $model)
    {
        parent::__construct($model);
    }
}
