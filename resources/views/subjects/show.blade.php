@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">College Subject Details</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Subject ID</th>
                            <td>{{ $subject->id }}</td>
                        </tr>

                        <tr>
                            <th>Subject Code</th>
                            <td>{{ $subject->subjectcode }}</td>
                        </tr>

                        <tr>
                            <th>Subject Name</th>
                            <td>{{ $subject->subjectname }}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>{{ $subject->description ?? 'No description available' }}</td>
                        </tr>

                        <tr>
                            <th>Units</th>
                            <td>{{ $subject->units }}</td>
                        </tr>

                        <tr>
                            <th>Category</th>
                            <td>College Subject</td>
                        </tr>
                    </table>

                    <a href="{{ route('subjects.edit', $subject->id) }}"
                       class="btn btn-warning">
                        Edit Subject
                    </a>

                    <a href="{{ route('subjects.index') }}"
                       class="btn btn-secondary">
                        Back to Subjects
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection