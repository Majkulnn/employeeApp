<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        if ($request->get('search')) {
            $searchValue = $request->get('search');
            $countries = Country::where('name', 'like', '%'.$searchValue.'%')
                        ->orWhere('country_code', 'like', '%'.$searchValue.'%')
                        ->get();
        } else {
            $countries = Country::all();
        }

        return inertia('Countries/index', [
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return inertia('Countries/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'country_code' => 'required|uppercase|max:3|unique:'.Country::class,
            'name' => 'required|string|max:255|unique:'.Country::class,
        ]);

        Country::create([
            'country_code' => $request->country_code,
            'name' => $request->name,
        ]);

        return redirect(route('countries.index'))->with('success', 'Country successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country): Response
    {
        return inertia('Countries/edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country): RedirectResponse
    {
        $request->validate([
            'country_code' => 'required|uppercase|max:3|unique:'.Country::class.',country_code,'.$country->id.',id',
            'name' => 'required|string|max:255|unique:'.Country::class.',name,'.$country->id.',id',
        ]);

        $country->update([
            'country_code' => $request->country_code,
            'name' => $request->name,
        ]);

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country): RedirectResponse
    {
        $country->deleteOrFail();

        return redirect(route('countries.index'));
    }
}
