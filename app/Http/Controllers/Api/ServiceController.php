<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() { 
        return Service::all();
    }


    public function store(Request $request) 
    {
        $request->validate ([
            'name'  => 'required|string|max:255',
            'price' =>  'required|numeric',
            'description' => 'required|string',
        ]);

        $service = Service::create ([
            'user_id' => $request->user()->id,
            'name'    => $request->name,
            'description' => $request->description,
            'price'   => $request->price,        
        ]);
        return response()->json($service, 201);

    }


    public function show(Service $service) {
        return $service;
    }


    public function update(Request $request, Service $service) {

        $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price'   =>  'sometimes|required|numeric',
        ]);

        $service->update($request->all());
        return response()->json($service);

    }


    public function delete(Service $service) {
        $service->delete();
        return response()->json(['message', 'Service deleted successfully']);
    }

}
