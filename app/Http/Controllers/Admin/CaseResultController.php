<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseResult;

class CaseResultController extends Controller
{
    public function index()
    {
        $caseResults = CaseResult::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.case-results.index', compact('caseResults'));
    }

    public function create()
    {
        return view('admin.case-results.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'practice_area' => 'required|string|max:255',
            'result_type' => 'required|string|max:255',
            'date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        CaseResult::create($data);

        return redirect()->route('admin.case-results.index')->with('status', 'Case result created');
    }

    public function edit(CaseResult $caseResult)
    {
        return view('admin.case-results.edit', compact('caseResult'));
    }

    public function update(Request $request, CaseResult $caseResult)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'practice_area' => 'required|string|max:255',
            'result_type' => 'required|string|max:255',
            'date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $caseResult->update($data);

        return redirect()->route('admin.case-results.index')->with('status', 'Case result updated');
    }

    public function destroy(CaseResult $caseResult)
    {
        $caseResult->delete();
        return redirect()->route('admin.case-results.index')->with('status', 'Case result deleted');
    }
}
