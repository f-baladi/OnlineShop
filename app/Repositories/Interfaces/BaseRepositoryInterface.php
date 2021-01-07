<?php


namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
interface BaseRepositoryInterface
{
    public function all(Request $request);

    public function create(Request $request);

    public function update(Request $request , Model $model);

    public function delete(Model $model);

    public function uploadImage(Request $request);
}
