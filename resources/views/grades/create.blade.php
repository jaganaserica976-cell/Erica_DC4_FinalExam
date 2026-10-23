@extends('layouts.app')

@section('title', 'Add Grade')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Add Student Grade</h3>

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}"
                        @selected(old('student_id') == $student->id)>
                        {{ $student->studentnumber }} -
                        {{ $student->firstname }} {{ $student->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Class / Subject</label>
            <select name="class_id" class="form-select" required>
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        @selected(old('class_id') == $class->id)>
                        {{ $class->subject?->subjectname ?? 'Subject' }}
                        — {{ $class->section }}
                        ({{ $class->school_year }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Prelim Grade</label>
                <input type="number" name="prelimgrade" class="form-control"
                       min="0" max="100" step="0.01"
                       value="{{ old('prelimgrade') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Midterm Grade</label>
                <input type="number" name="midtermgrade" class="form-control"
                       min="0" max="100" step="0.01"
                       value="{{ old('midtermgrade') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Final Grade</label>
                <input type="number" name="finalgrade" class="form-control"
                       min="0" max="100" step="0.01"
                       value="{{ old('finalgrade') }}">
            </div>
        </div>

        <p class="text-muted">
            The final average and remarks will be calculated automatically
            when all three grades are entered.
        </p>

        <button type="submit" class="btn btn-primary">Save Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection