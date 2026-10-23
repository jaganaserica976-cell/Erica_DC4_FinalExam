@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>College Subjects</h2>

        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
            + Add Subject
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Units</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $subjects = [
                        ['code' => 'IT101', 'name' => 'Introduction to Computing', 'units' => 3],
                        ['code' => 'PROG101', 'name' => 'Computer Programming 1', 'units' => 3],
                        ['code' => 'PROG102', 'name' => 'Computer Programming 2', 'units' => 3],
                        ['code' => 'DB101', 'name' => 'Database Management Systems', 'units' => 3],
                        ['code' => 'WEB101', 'name' => 'Web Development', 'units' => 3],
                        ['code' => 'NET101', 'name' => 'Networking 1', 'units' => 3],
                        ['code' => 'SAD101', 'name' => 'Systems Analysis and Design', 'units' => 3],
                        ['code' => 'HCI101', 'name' => 'Human-Computer Interaction', 'units' => 3],
                        ['code' => 'IM101', 'name' => 'Information Management', 'units' => 3],
                        ['code' => 'PF101', 'name' => 'Platform Technologies', 'units' => 3],
                        ['code' => 'GE101', 'name' => 'Understanding the Self', 'units' => 3],
                        ['code' => 'GE102', 'name' => 'Readings in Philippine History', 'units' => 3],
                        ['code' => 'MATH101', 'name' => 'Mathematics in the Modern World', 'units' => 3],
                        ['code' => 'PE101', 'name' => 'Physical Education', 'units' => 2],
                        ['code' => 'NSTP101', 'name' => 'National Service Training Program', 'units' => 3],
                        ['code' => 'ETH101', 'name' => 'Ethics', 'units' => 3],
                        ['code' => 'OOP101', 'name' => 'Object-Oriented Programming', 'units' => 3],
                        ['code' => 'CAP101', 'name' => 'Capstone Project', 'units' => 3],
                    ];
                @endphp

                @foreach($subjects as $index => $subject)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subject['code'] }}</td>
                        <td>{{ $subject['name'] }}</td>
                        <td>{{ $subject['units'] }}</td>
                        <td>
                            <span class="badge bg-info text-dark">College</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection