@extends('layouts.app')

@section('title', 'Class Details')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Class Details</h3>

    <p>
        <strong>Subject:</strong>
        {{ $class->subject?->subjectname ?? 'N/A' }}
    </p>

    <p>
        <strong>Teacher:</strong>
        {{ $class->teacher?->firstname ?? '' }}
        {{ $class->teacher?->lastname ?? '' }}
    </p>

    <p><strong>School Year:</strong> {{ $class->school_year }}</p>
    <p><strong>Semester:</strong> {{ $class->semester }}</p>
    <p><strong>Section:</strong> {{ $class->section }}</p>

    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
        Back to Classes
    </a>

    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-primary">
        Edit Class
    </a>
</div>
@endsection