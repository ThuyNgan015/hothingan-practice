<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhoneController extends Controller
{
    public function index()
    {
        return Phone::all();
    }

    public function store(Request $request)
    {
        return Phone::create($request->all());
    }

    public function show($id)
    {
        return Phone::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);
        $phone->update($request->all());
        return $phone;
    }

    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();
        return 204;
    }
}