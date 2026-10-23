@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h3 class="page-title mb-4">Edit Student</h3>

            <form action="{{ route('students.update', $student->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Student Number</label>
                    <input type="text" name="studentnumber"
                           class="form-control"
                           value="{{ old('studentnumber', $student->studentnumber) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname"
                           class="form-control"
                           value="{{ old('firstname', $student->firstname) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname"
                           class="form-control"
                           value="{{ old('lastname', $student->lastname) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="{{ old('email', $student->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Course</label>
                    <input type="text" name="course"
                           class="form-control"
                           value="{{ old('course', $student->course) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Grade Level</label>
                    <input type="text" name="gradelevel"
                           class="form-control"
                           value="{{ old('gradelevel', $student->gradelevel) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Section</label>
                    <input type="text" name="section"
                           class="form-control"
                           value="{{ old('section', $student->section) }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Student
                </button>

                <a href="{{ route('students.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection