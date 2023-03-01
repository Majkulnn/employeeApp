<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateStoreRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class StateController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->get('search')) {
            $searchValue = $request->get('search');
            $states = State::where('name','like','%'.$searchValue.'%')
                ->with('country')
                ->get();
        }else $states = State::with('country')->get();
        return inertia('States/index',[
            'states' => $states,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        $countries = Country::all('id','name');

        return inertia('States/create', [
            'countries' => $countries
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateStoreRequest $request):RedirectResponse
    {
        $country = Country::find($request->country_id);
        $country->states()->create($request->validated());

        return redirect(route('states.index'))->with('success','State successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state): Response
    {
        $countries = Country::all();
        return inertia('States/edit',[
            'state' => $state,
            'countries' => $countries
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateStoreRequest $request, State $state): RedirectResponse
    {
        $state->update([
            'country_id' => $request->country_id,
            'name' => $request->name,
        ]);

        return redirect(route('states.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state): RedirectResponse
    {
        $state->deleteOrFail();

        return redirect(route('states.index'));
    }
}
