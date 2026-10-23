@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Edit Class</h3>

    <form action="{{ route('classes.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @selected(old('subject_id', $class->subject_id) == $subject->id)>
                        {{ $subject->subjectcode }} - {{ $subject->subjectname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        @selected(old('teacher_id', $class->teacher_id) == $teacher->id)>
                        {{ $teacher->firstname }} {{ $teacher->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">School Year</label>
            <input type="text" name="school_year" class="form-control"
                   value="{{ old('school_year', $class->school_year) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                @foreach(['1st Semester', '2nd Semester', 'Summer'] as $semester)
                    <option value="{{ $semester }}"
                        @selected(old('semester', $class->semester) == $semester)>
                        {{ $semester }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Section</label>
            <input type="text" name="section" class="form-control"
                   value="{{ old('section', $class->section) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Class</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection