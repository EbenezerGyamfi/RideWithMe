<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    //

    public function index(){
        $user = auth()->user();

        $user->load('driver');


        return $user;
    }

    public function update(Request $request){

        
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'make' => 'required',
            'model' => 'model',
            'color' => 'required',
            'lincense_plate' => 'required'
        ]);

        $user->update($request->only('name'));

        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'lincense_plate'
        ]));


        return $user->load('driver');
    }
}
