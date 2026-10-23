@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Edit College Subject</h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('subjects.update', $subject->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="subjectcode" class="form-label">
                                Subject Code
                            </label>
                            <input
                                type="text"
                                name="subjectcode"
                                id="subjectcode"
                                class="form-control"
                                value="{{ old('subjectcode', $subject->subjectcode) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="subjectname" class="form-label">
                                Subject Name
                            </label>
                            <input
                                type="text"
                                name="subjectname"
                                id="subjectname"
                                class="form-control"
                                value="{{ old('subjectname', $subject->subjectname) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                class="form-control"
                                rows="3"
                            >{{ old('description', $subject->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="units" class="form-label">
                                Units
                            </label>
                            <input
                                type="number"
                                name="units"
                                id="units"
                                class="form-control"
                                value="{{ old('units', $subject->units) }}"
                                min="1"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-success">
                            Update Subject
                        </button>

                        <a href="{{ route('subjects.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection