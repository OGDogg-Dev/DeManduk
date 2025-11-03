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
        $data = $this->validatedData($request, false);
        $project = new HomeProject();
        $this->persistProject($project, $data, $request);

        return redirect()->route('admin.home.projects.index')
            ->with('status', 'Agenda beranda berhasil ditambahkan.');
    }

    public function edit(HomeProject $project): View
    {
        return view('admin.home.projects.edit', compact('project'));
    }

    public function update(Request $request, HomeProject $project): RedirectResponse
    {
        $data = $this->validatedData($request, true);
        $this->persistProject($project, $data, $request);

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

    private function validatedData(Request $request, bool $isUpdate): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function persistProject(HomeProject $project, array $data, Request $request): void
    {
        $removeImage = ! empty($data['remove_image']);
        unset($data['remove_image']);

        $imagePath = $project->image_path;
        if ($removeImage && $imagePath) {
            $this->deleteStoredFile($imagePath);
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
            $imagePath = $this->storeUploadedFile($request, 'image', 'home/projects', $project->image_path);
        }

        unset($data['image']);

        $data['sort_order'] = isset($data['sort_order']) && $data['sort_order'] !== null
            ? (int) $data['sort_order']
            : 0;

        $project->fill(array_merge(
            $data,
            ['image_path' => $imagePath]
        ));

        $project->save();
    }
}
