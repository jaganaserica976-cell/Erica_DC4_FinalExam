<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with([
            'student',
            'schoolClass.subject',
            'schoolClass.teacher'
        ])->latest()->paginate(10);

        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $students = Student::orderBy('lastname')->get();
        $classes = SchoolClass::with('subject')->get();

        return view('grades.create', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'prelimgrade' => 'nullable|numeric|min:0|max:100',
            'midtermgrade' => 'nullable|numeric|min:0|max:100',
            'finalgrade' => 'nullable|numeric|min:0|max:100',
        ]);

        $average = $this->calculateAverage($data);

        $data['final_average'] = $average;
        $data['remarks'] = $average === null
            ? 'Incomplete'
            : ($average >= 75 ? 'Passed' : 'Failed');

        Grade::create($data);

        return redirect()->route('grades.index')
            ->with('success', 'Grade recorded successfully.');
    }

    public function show(Grade $grade)
    {
        $grade->load('student', 'schoolClass.subject');

        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $students = Student::orderBy('lastname')->get();
        $classes = SchoolClass::with('subject')->get();

        return view('grades.edit', compact(
            'grade', 'students', 'classes'
        ));
    }

    public function update(Request $request, Grade $grade)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'prelimgrade' => 'nullable|numeric|min:0|max:100',
            'midtermgrade' => 'nullable|numeric|min:0|max:100',
            'finalgrade' => 'nullable|numeric|min:0|max:100',
        ]);

        $average = $this->calculateAverage($data);

        $data['final_average'] = $average;
        $data['remarks'] = $average === null
            ? 'Incomplete'
            : ($average >= 75 ? 'Passed' : 'Failed');

        $grade->update($data);

        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
            ->with('success', 'Grade deleted successfully.');
    }

    private function calculateAverage(array $data): ?float
    {
        $values = [
            $data['prelimgrade'] ?? null,
            $data['midtermgrade'] ?? null,
            $data['finalgrade'] ?? null,
        ];

        if (in_array(null, $values, true)) {
            return null;
        }

        return round(array_sum($values) / 3, 2);
    }
}