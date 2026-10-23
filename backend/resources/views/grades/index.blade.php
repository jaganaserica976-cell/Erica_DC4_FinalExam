@extends('layouts.app')

@section('title', 'Grade Management')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title">Grade Management</h3>
        <a href="{{ route('grades.create') }}" class="btn btn-primary">
            Add Grade
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Prelim</th>
                    <th>Midterm</th>
                    <th>Final</th>
                    <th>Average</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                    <tr>
                        <td>
                            {{ $grade->student?->firstname ?? '' }}
                            {{ $grade->student?->lastname ?? '' }}
                        </td>
                        <td>
                            {{ $grade->schoolClass?->subject?->subjectname ?? 'N/A' }}
                        </td>
                        <td>{{ $grade->prelimgrade ?? '-' }}</td>
                        <td>{{ $grade->midtermgrade ?? '-' }}</td>
                        <td>{{ $grade->finalgrade ?? '-' }}</td>
                        <td>{{ $grade->final_average ?? '-' }}</td>
                        <td>{{ $grade->remarks ?? 'Incomplete' }}</td>
                        <td>
                            <a href="{{ route('grades.show', $grade->id) }}"
                               class="btn btn-info btn-sm">View</a>

                            <a href="{{ route('grades.edit', $grade->id) }}"
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('grades.destroy', $grade->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this grade?')">
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
                        <td colspan="8" class="text-center">No grades found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $grades->links() }}
</div>
@endsection