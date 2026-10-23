@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title">Class Management</h3>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            Add Class
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>School Year</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                    <tr>
                        <td>{{ $class->subject?->subjectname ?? 'N/A' }}</td>
                        <td>
                            {{ $class->teacher?->firstname ?? '' }}
                            {{ $class->teacher?->lastname ?? '' }}
                        </td>
                        <td>{{ $class->school_year }}</td>
                        <td>{{ $class->semester }}</td>
                        <td>{{ $class->section }}</td>
                        <td>
                            <a href="{{ route('classes.show', $class->id) }}"
                               class="btn btn-info btn-sm">View</a>

                            <a href="{{ route('classes.edit', $class->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('classes.destroy', $class->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this class?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No classes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $classes->links() }}
</div>
@endsection