@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="card p-4">
    <h3 class="page-title mb-4">Edit Teacher</h3>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Teacher Number</label>
            <input name="teachernumber" class="form-control"
                   value="{{ old('teachernumber', $teacher->teachernumber) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input name="firstname" class="form-control"
                   value="{{ old('firstname', $teacher->firstname) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input name="lastname" class="form-control"
                   value="{{ old('lastname', $teacher->lastname) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teacher Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $teacher->email) }}">
        </div>

        <button class="btn btn-primary">Update Teacher</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>
@endsection