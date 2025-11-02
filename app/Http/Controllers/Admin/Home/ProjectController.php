<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Admin\Concerns\StoresMedia;
use App\Http\Controllers\Controller;
use App\Models\HomeProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use StoresMedia;

    public function index(): View
    {
        $projects = HomeProject::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.home.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.home.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedFile($request, 'image', 'home/projects');

        HomeProject::create($data);

        return redirect()->route('admin.home.projects.index')
            ->with('status', 'Agenda beranda berhasil ditambahkan.');
    }

    public function edit(HomeProject $project): View
    {
        return view('admin.home.projects.edit', compact('project'));
    }

    public function update(Request $request, HomeProject $project): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedFile($request, 'image', 'home/projects', $project->image_path);

        $project->update($data);

        return redirect()->route('admin.home.projects.index')
            ->with('status', 'Agenda beranda berhasil diperbarui.');
    }

    public function destroy(HomeProject $project): RedirectResponse
    {
        $this->deleteStoredFile($project->image_path);
        $project->delete();

        return redirect()->route('admin.home.projects.index')
            ->with('status', 'Agenda beranda berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        unset($data['image']);

        if (! isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        return $data;
    }
}
