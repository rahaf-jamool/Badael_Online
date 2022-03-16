<?php

namespace App\Repositories\Interfaces;

interface PortfolioRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function show();

    public function edit($portfolio);

    public function update($request, $portfolio);

    public function destroy($portfolio);

}
