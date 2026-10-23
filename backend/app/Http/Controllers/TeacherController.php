<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teachernumber' => 'required|string|max:50|unique:teachers,teachernumber',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['firstname'] . ' ' . $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Teacher',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'teachernumber' => $data['teachernumber'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
        ]);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher added successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('classes.subject');

        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'teachernumber' => [
                'required', 'string', 'max:50',
                Rule::unique('teachers', 'teachernumber')->ignore($teacher->id),
            ],
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'nullable|email',
        ]);

        $teacher->update($data);

        if ($teacher->user) {
            $teacher->user->update([
                'name' => $data['firstname'] . ' ' . $data['lastname'],
            ]);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}