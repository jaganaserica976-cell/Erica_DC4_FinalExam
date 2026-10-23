@extends('layouts.app')

@section('title', 'Grade Details')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Grade Details</h3>

    <p>
        <strong>Student:</strong>
        {{ $grade->student?->firstname ?? '' }}
        {{ $grade->student?->lastname ?? '' }}
    </p>

    <p>
        <strong>Subject:</strong>
        {{ $grade->schoolClass?->subject?->subjectname ?? 'N/A' }}
    </p>

    <p><strong>Prelim Grade:</strong> {{ $grade->prelimgrade ?? '-' }}</p>
    <p><strong>Midterm Grade:</strong> {{ $grade->midtermgrade ?? '-' }}</p>
    <p><strong>Final Grade:</strong> {{ $grade->finalgrade ?? '-' }}</p>
    <p><strong>Final Average:</strong> {{ $grade->final_average ?? 'Incomplete' }}</p>
    <p><strong>Remarks:</strong> {{ $grade->remarks ?? 'Incomplete' }}</p>

    <a href="{{ route('grades.index') }}" class="btn btn-secondary">
        Back to Grades
    </a>

    <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-primary">
        Edit Grade
    </a>
</div>
@endsection