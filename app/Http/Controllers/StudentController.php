<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'studentnumber' => 'required|string|max:50|unique:students,studentnumber',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'course' => 'nullable|string|max:100',
            'gradelevel' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
            'login_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['firstname'] . ' ' . $data['lastname'],
            'email' => $data['login_email'],
            'password' => Hash::make($data['password']),
            'role' => 'Student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'studentnumber' => $data['studentnumber'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'] ?? null,
            'course' => $data['course'] ?? null,
            'gradelevel' => $data['gradelevel'] ?? null,
            'section' => $data['section'] ?? null,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('grades.schoolClass.subject');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'studentnumber' => [
                'required', 'string', 'max:50',
                Rule::unique('students', 'studentnumber')->ignore($student->id),
            ],
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'course' => 'nullable|string|max:100',
            'gradelevel' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
        ]);

        $student->update($data);

        if ($student->user) {
            $student->user->update([
                'name' => $data['firstname'] . ' ' . $data['lastname'],
            ]);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}