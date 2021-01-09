<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface PriceRepositoryInterface
{
    public function dataPrepare();

    public function priceUpdate($request);

    public function check(Request $request);
}
