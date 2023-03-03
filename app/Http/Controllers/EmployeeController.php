<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $employees = Employee::with('department', 'city')->get();

        return inertia('Employees/index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return inertia('Employees/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $employee = Employee::with('department', 'country', 'state', 'city')->where('id', $id)->get();

        return inertia('Employees/show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $employee = Employee::with('department', 'country', 'state', 'city')->where('id', $id)->get();

        return inertia('Employees/edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->deleteOrFail();

        return redirect(route('employees.index'));
    }
}
