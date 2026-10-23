@extends('layouts.app')

@section('title', 'Edit Grade')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Edit Grade</h3>

    <form action="{{ route('grades.update', $grade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}"
                        @selected(old('student_id', $grade->student_id) == $student->id)>
                        {{ $student->studentnumber }} -
                        {{ $student->firstname }} {{ $student->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Class / Subject</label>
            <select name="class_id" class="form-select" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        @selected(old('class_id', $grade->class_id) == $class->id)>
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
                       value="{{ old('prelimgrade', $grade->prelimgrade) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Midterm Grade</label>
                <input type="number" name="midtermgrade" class="form-control"
                       min="0" max="100" step="0.01"
                       value="{{ old('midtermgrade', $grade->midtermgrade) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Final Grade</label>
                <input type="number" name="finalgrade" class="form-control"
                       min="0" max="100" step="0.01"
                       value="{{ old('finalgrade', $grade->finalgrade) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection