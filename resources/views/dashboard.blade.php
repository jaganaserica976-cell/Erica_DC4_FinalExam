@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5>Welcome, {{ $user->name }}!</h5>
        <p class="mb-0">
            Your role: <strong>{{ $user->role }}</strong>
        </p>
    </div>
</div>

@if($user->role === 'Admin')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <h6>Students</h6>
                    <h2>{{ $studentCount }}</h2>
                    <a class="text-white" href="{{ route('students.index') }}">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <h6>Teachers</h6>
                    <h2>{{ $teacherCount }}</h2>
                    <a class="text-white" href="{{ route('teachers.index') }}">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-info h-100">
                <div class="card-body">
                    <h6>Subjects</h6>
                    <h2>{{ $subjectCount }}</h2>
                    <a class="text-dark" href="{{ route('subjects.index') }}">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h6>Grade Records</h6>
                    <h2>{{ $gradeCount }}</h2>
                    <a class="text-dark" href="{{ route('grades.index') }}">Manage</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('students.index') }}" class="btn btn-outline-primary">Students</a>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-primary">Teachers</a>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-primary">Subjects</a>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-primary">Classes</a>
        <a href="{{ route('grades.index') }}" class="btn btn-outline-primary">Grades</a>
    </div>
@elseif($user->role === 'Teacher')
    <a href="{{ route('teacher.grades.index') }}" class="btn btn-primary">
        Manage Grades
    </a>
@elseif($user->role === 'Student')
    <h4 class="mt-4">My Grades</h4>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Prelim</th>
                    <th>Midterm</th>
                    <th>Final</th>
                    <th>Average</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myGrades as $grade)
                    <tr>
                        <td>{{ $grade->schoolClass?->subject?->subjectname ?? 'N/A' }}</td>
                        <td>{{ $grade->prelimgrade ?? '—' }}</td>
                        <td>{{ $grade->midtermgrade ?? '—' }}</td>
                        <td>{{ $grade->finalgrade ?? '—' }}</td>
                        <td>{{ $grade->final_average ?? 'Incomplete' }}</td>
                        <td>{{ $grade->remarks ?? 'Incomplete' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No grades available yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endif
@endsection
