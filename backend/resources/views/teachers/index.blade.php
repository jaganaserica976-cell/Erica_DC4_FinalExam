@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="page-title">Teachers</h3>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">
            Add Teacher
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Teacher Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->teachernumber }}</td>
                        <td>{{ $teacher->firstname }} {{ $teacher->lastname }}</td>
                        <td>{{ $teacher->email ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('teachers.show', $teacher->id) }}"
                               class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No teachers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $teachers->links() }}
</div>
@endsection