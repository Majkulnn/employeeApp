<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityStoreRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class CityController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->get('search')) {
            $searchValue = $request->get('search');
            $cities = City::whereHas('state', function (Builder $query) use ($searchValue) {
                    $query->where('name', 'like', '%'.$searchValue.'%');
                })
                ->orWhere('name','like','%'.$searchValue.'%')
                ->with('state')
                ->get();
        }else $cities = City::with('state')->latest()->get();
        return inertia('Cities/index',[
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        $states = State::all('id','name');

        return inertia('Cities/create', [
            'states' => $states
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityStoreRequest $request):RedirectResponse
    {
        $state = State::find($request->state_id);
        $state->cities()->create($request->validated());

        return redirect(route('cities.index'))->with('success','City successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): Response
    {
        $states = State::all();
        return inertia('Cities/edit',[
            'states' => $states,
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityStoreRequest $request, City $city): RedirectResponse
    {
        $city->update([
            'state_id' => $request->state_id,
            'name' => $request->name,
        ]);

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        $city->deleteOrFail();

        return redirect(route('cities.index'));
    }
}
