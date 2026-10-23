@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Add Teacher</h3>

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Teacher Number</label>
            <input name="teachernumber" class="form-control"
                   value="{{ old('teachernumber') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input name="firstname" class="form-control"
                   value="{{ old('firstname') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input name="lastname" class="form-control"
                   value="{{ old('lastname') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teacher Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Login Email</label>
            <input type="email" name="login_email" class="form-control"
                   value="{{ old('login_email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Temporary Password</label>
            <input type="password" name="password" class="form-control"
                   required minlength="8">
        </div>

        <button class="btn btn-primary">Save Teacher</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>
@endsection