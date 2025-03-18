<?php
namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(Country::with('cities')->get());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:countries']);
        return response()->json(Country::create($request->all()));
    }

    public function show($id)
    {
        return response()->json(Country::with('cities')->findOrFail($id));
    }

    public function get_country_cities($id)
    {
        $country = Country::with('cities')->findOrFail($id);
        return CityResource::collection($country->cities); 
    }

    public function get_country_population($id)
    {
        return response()->json(Country::with('cities')->findOrFail($id)->cities->sum('population'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $request->validate(['name' => 'required|unique:countries,name,' . $id]);
        $country->update($request->all());
        return response()->json($country);
    }

    public function destroy($id)
    {
        Country::findOrFail($id)->delete();
        return response()->json(['message' => 'Uğurla silindi']);
    }

    public function search_country(Request $request)
    {
        $request->validate(['name' => 'required']);
        $countries = Country::where('name', 'like', '%' . $request->name . '%')->get();
    
        if ($countries->isEmpty()) {
            return response()->json(['message' => 'Ölkə tapılmadı'], 404);
        }
    
        return response()->json($countries);
    }
}
