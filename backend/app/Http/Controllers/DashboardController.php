<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $subjectCount = Subject::count();
        $gradeCount = Grade::count();

        $myGrades = collect();

        if ($user->role === 'Student') {
            $student = Student::where('user_id', $user->id)->first();

            if ($student) {
                $myGrades = Grade::with('schoolClass.subject')
                    ->where('student_id', $student->id)
                    ->latest()
                    ->get();
            }
        }

        return view('dashboard', compact(
            'user',
            'studentCount',
            'teacherCount',
            'subjectCount',
            'gradeCount',
            'myGrades'
        ));
    }
}