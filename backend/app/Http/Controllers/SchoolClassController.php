<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with(['subject', 'teacher'])
            ->latest()->paginate(10);

        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('classes.create', compact('subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'school_year' => 'required|string|max:20',
            'semester' => 'required|string|max:50',
            'section' => 'required|string|max:50',
        ]);

        SchoolClass::create($data);

        return redirect()->route('classes.index')
            ->with('success', 'Class added successfully.');
    }

    public function show(SchoolClass $schoolClass)
    {
        $schoolClass->load(['subject', 'teacher', 'grades.student']);

        return view('classes.show', ['schoolClass' => $schoolClass]);
    }

    public function edit(SchoolClass $schoolClass)
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('classes.edit', compact(
            'schoolClass', 'subjects', 'teachers'
        ));
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'school_year' => 'required|string|max:20',
            'semester' => 'required|string|max:50',
            'section' => 'required|string|max:50',
        ]);

        $schoolClass->update($data);

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
