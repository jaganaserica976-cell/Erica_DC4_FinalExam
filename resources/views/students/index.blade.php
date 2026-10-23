@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        + Add Student
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th>Student No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course / Grade Level</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->studentnumber }}</td>
                        <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                        <td>{{ $student->email ?? '—' }}</td>
                        <td>{{ $student->course ?? $student->gradelevel ?? '—' }}</td>
                        <td>{{ $student->section ?? '—' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('students.show', $student) }}"
                               class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('students.edit', $student) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this student?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $students->links() }}</div>
@endsection