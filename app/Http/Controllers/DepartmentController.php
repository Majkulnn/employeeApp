<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class DepartmentController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->get('search')) {
            $searchValue = $request->get('search');
            $departments = Department::where('name', 'like', '%'.$searchValue.'%')
                ->orWhere('country_code', 'like', '%'.$searchValue.'%')
                ->get();
        } else {
            $departments = Department::all();
        }

        return inertia('Departments/index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return inertia('Departments/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentStoreRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return redirect(route('departments.index'))->with('success', 'Country successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): Response
    {
        return inertia('Departments/edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentStoreRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): RedirectResponse
    {
        $department->deleteOrFail();

        return redirect(route('departments.index'));
    }
}
