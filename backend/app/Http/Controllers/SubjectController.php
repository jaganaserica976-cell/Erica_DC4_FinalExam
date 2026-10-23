<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subjectcode' => 'required|string|max:50|unique:subjects,subjectcode',
            'subjectname' => 'required|string|max:150',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1|max:10',
        ]);

        Subject::create($data);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject added successfully.');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'subjectcode' => [
                'required', 'string', 'max:50',
                Rule::unique('subjects', 'subjectcode')->ignore($subject->id),
            ],
            'subjectname' => 'required|string|max:150',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1|max:10',
        ]);

        $subject->update($data);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
