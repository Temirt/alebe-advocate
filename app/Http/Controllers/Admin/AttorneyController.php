<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attorney;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttorneyController extends Controller
{
    public function index()
    {
        $attorneys = Attorney::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.attorneys.index', compact('attorneys'));
    }

    public function create()
    {
        return view('admin.attorneys.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo' => 'nullable|image|max:4096',
            'education' => 'nullable|string',
            'bar_admissions' => 'nullable|string',
            'awards' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name']);
        $data['education'] = $this->linesToArray($data['education'] ?? null);
        $data['bar_admissions'] = $this->linesToArray($data['bar_admissions'] ?? null);
        $data['awards'] = $this->linesToArray($data['awards'] ?? null);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = (int)($data['order'] ?? 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('attorneys', 'public');
            $data['photo'] = Storage::url($path);
        }

        Attorney::create($data);

        return redirect()->route('admin.attorneys.index')->with('status', 'Attorney created');
    }

    public function edit(Attorney $attorney)
    {
        return view('admin.attorneys.edit', compact('attorney'));
    }

    public function update(Request $request, Attorney $attorney)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo' => 'nullable|image|max:4096',
            'education' => 'nullable|string',
            'bar_admissions' => 'nullable|string',
            'awards' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $requestedSlug = $data['slug'] ?? $data['name'];
        if ($requestedSlug !== $attorney->slug) {
            $data['slug'] = $this->uniqueSlug($requestedSlug, $attorney->id);
        } else {
            $data['slug'] = $attorney->slug;
        }

        $data['education'] = $this->linesToArray($data['education'] ?? null);
        $data['bar_admissions'] = $this->linesToArray($data['bar_admissions'] ?? null);
        $data['awards'] = $this->linesToArray($data['awards'] ?? null);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = (int)($data['order'] ?? 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('attorneys', 'public');
            $data['photo'] = Storage::url($path);
        }

        $attorney->update($data);

        return redirect()->route('admin.attorneys.index')->with('status', 'Attorney updated');
    }

    public function destroy(Attorney $attorney)
    {
        $attorney->delete();
        return redirect()->route('admin.attorneys.index')->with('status', 'Attorney deleted');
    }

    private function linesToArray(?string $value): ?array
    {
        if ($value === null) {
            return null;
        }
        $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value)));
        return $lines ?: null;
    }

    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base);
        if ($slug === '') {
            $slug = 'attorney';
        }

        $original = $slug;
        $i = 1;

        while (
            Attorney::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
