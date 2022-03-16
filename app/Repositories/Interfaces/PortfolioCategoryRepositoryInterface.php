<?php

namespace App\Repositories\Interfaces;


interface PortfolioCategoryRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function show();

    public function edit($portfolioCategory);

    public function update($request, $portfolioCategory);

    public function destroy($portfolioCategory);
}
