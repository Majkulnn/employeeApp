<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class EmployeeDataController extends Controller
{
    public function countries()
    {
        $countries = Country::all();

        return response()->json($countries);
    }

    public function departments(): JsonResponse
    {
        $departments = Department::all();

        return response()->json($departments);
    }

    public function states(int $id): JsonResponse
    {
        $states = State::whereHas('country', function (Builder $query) use ($id) {
            $query->where('id', $id);
        })->get();

        return response()->json($states);
    }

    public function cities(int $id): JsonResponse
    {
        $cities = City::whereHas('state', function (Builder $query) use ($id) {
            $query->where('id', $id);
        })->get();

        return response()->json($cities);
    }
}
