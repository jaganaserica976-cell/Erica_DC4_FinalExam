@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<h2 class="mb-3">Add Student</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Student Number</label>
                    <input name="studentnumber" value="{{ old('studentnumber') }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input name="firstname" value="{{ old('firstname') }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input name="lastname" value="{{ old('lastname') }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Student Contact Email (optional)</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <input name="course" value="{{ old('course') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Grade Level</label>
                    <input name="gradelevel" value="{{ old('gradelevel') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Section</label>
                    <input name="section" value="{{ old('section') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Login Email</label>
                    <input type="email" name="login_email"
                           value="{{ old('login_email') }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Temporary Password</label>
                    <input type="password" name="password"
                           class="form-control" minlength="8" required>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection