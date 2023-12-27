<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
 
    public function createDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments'
        ]);

        $department = Department::create($request->all());
        return response()->json($department, 201);
    }

  
    public function editDepartment(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:departments,name,'.$department->id
        ]);

        $department->update($validatedData);
        return response()->json(['message' => 'Karyawan berhasil diperbarui'], 200);
    }

    
    public function getAllDepartments()
    {
        $departments = Department::all();
        return response()->json($departments, 200);
    }

 
    public function getDepartmentsByName(Request $request)
    {
        $name = $request->query('name');
        $departments = Department::where('name', $name)->get();
        return response()->json($departments, 200);
    }
}
