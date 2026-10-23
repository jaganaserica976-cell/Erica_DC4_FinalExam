@extends('layouts.app')

@section('title', 'Add Class')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Add Class</h3>

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @selected(old('subject_id') == $subject->id)>
                        {{ $subject->subjectcode }} - {{ $subject->subjectname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select" required>
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        @selected(old('teacher_id') == $teacher->id)>
                        {{ $teacher->firstname }} {{ $teacher->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">School Year</label>
            <input type="text" name="school_year" class="form-control"
                   placeholder="2026-2027"
                   value="{{ old('school_year') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="">Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
                <option value="Summer">Summer</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Section</label>
            <input type="text" name="section" class="form-control"
                   value="{{ old('section') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Class</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection