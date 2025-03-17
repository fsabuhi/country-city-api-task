<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return response()->json(City::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'population'=> 'required',
            'country_id' => 'required|exists:countries,id'
        ]);
        return response()->json(City::create($request->all()));
    }

    public function show($id)
    {
        return response()->json(City::with('country')->findOrFail($id));
    }


    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'country_id' => 'required|exists:countries,id'
        ]);
        $city->update($request->all());
        return response()->json($city);
    }

    public function destroy($id)
    {
        City::findOrFail($id)->delete();
        return response()->json(['message' => 'Uğurla silindi']);
    }

    public function add_population(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $request->validate([
            'population' => 'required|integer'
        ]);
        $city->population += $request->population;
        $city->save();
        return response()->json($city);
    }
    public function remove_population(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $city->population -= $request->population;
        $city->save();
        return response()->json($city);
    }

    public function search_by_name(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        return response()->json(City::where('name', 'like', '%' . $request->name . '%')->get());
    }

}
