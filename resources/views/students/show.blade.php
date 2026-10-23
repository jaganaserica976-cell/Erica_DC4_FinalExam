@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title">Student Details</h3>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Student Number:</strong>
            {{ $student->studentnumber }}
        </div>
        <div class="col-md-6">
            <strong>Name:</strong>
            {{ $student->firstname }} {{ $student->lastname }}
        </div>
        <div class="col-md-6 mt-3">
            <strong>Email:</strong>
            {{ $student->email ?? 'N/A' }}
        </div>
        <div class="col-md-6 mt-3">
            <strong>Course:</strong>
            {{ $student->course ?? 'N/A' }}
        </div>
        <div class="col-md-6 mt-3">
            <strong>Grade Level:</strong>
            {{ $student->gradelevel ?? 'N/A' }}
        </div>
        <div class="col-md-6 mt-3">
            <strong>Section:</strong>
            {{ $student->section ?? 'N/A' }}
        </div>
    </div>

    <hr>

    <h4 class="mb-3">Academic Grades</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Prelim</th>
                    <th>Midterm</th>
                    <th>Final</th>
                    <th>Final Average</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->grades as $grade)
                    <tr>
                        <td>
                            {{ $grade->schoolClass?->subject?->subjectname ?? 'N/A' }}
                        </td>
                        <td>{{ $grade->prelimgrade ?? '-' }}</td>
                        <td>{{ $grade->midtermgrade ?? '-' }}</td>
                        <td>{{ $grade->finalgrade ?? '-' }}</td>
                        <td>{{ $grade->final_average ?? '-' }}</td>
                        <td>{{ $grade->remarks ?? 'Incomplete' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No grades recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection