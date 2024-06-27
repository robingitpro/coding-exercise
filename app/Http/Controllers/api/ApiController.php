<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\DataService;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    private $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }
    public function store(Request $request)
    {
        $input = $request->all();
        return $this->dataService->create($input);
    }
    public function load(Request $request)
    {
        $input = $request->all();
        return $this->dataService->load($input);
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        return $this->dataService->edit($input);
    }
}
