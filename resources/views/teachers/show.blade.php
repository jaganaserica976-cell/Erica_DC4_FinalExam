@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Teacher Details</h3>

    <p><strong>Teacher Number:</strong> {{ $teacher->teachernumber }}</p>
    <p><strong>First Name:</strong> {{ $teacher->firstname }}</p>
    <p><strong>Last Name:</strong> {{ $teacher->lastname }}</p>
    <p><strong>Email:</strong> {{ $teacher->email ?? 'N/A' }}</p>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        Back to Teachers
    </a>
    <a href="{{ route('teachers.edit', $teacher->id) }}"
       class="btn btn-primary">Edit</a>
</div>
@endsection