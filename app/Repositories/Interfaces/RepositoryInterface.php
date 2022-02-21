<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface RepositoryInterface{

    public function index();

    public function create();

    public function store($request);

    public function show($id);

    public function edit($id);

    public function update(Request $request, $id);

    public function destroy($id);
}
