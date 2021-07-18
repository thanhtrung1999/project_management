<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Document;
use App\Models\Project;
use App\Repositories\TeacherRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    protected $teacherRepository;
    protected $projectService;

    public function __construct(TeacherRepository $teacherRepository, ProjectService $projectService)
    {
        $this->teacherRepository = $teacherRepository;
        $this->projectService = $projectService;
    }

    public function getListProjects()
    {
        $projects = getAccountInfo()->projects;
        return view('students.projects.index', [
            'projects' => $projects
        ]);
    }

    public function getFormCreate()
    {
        $teachers = $this->teacherRepository->all();
        return view('students.projects.create', [
            'teachers' => $teachers
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $response = $this->projectService->handleStore($request);
        if ($response['success']) {
            return redirect()->route('student.projects.index')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function getListProjectsOfStudents()
    {
        $projects = getAccountInfo()->projects;
        return view('teachers.projects.index', [
            'projects' => $projects
        ]);
    }

    public function showProject(Project $project)
    {
        return view('students.projects.detail', [
            'project' => $project
        ]);
    }

    public function getFormUpdate(Project $project)
    {
        $teachers = $this->teacherRepository->all();
        return view('students.projects.edit', [
            'project' => $project,
            'teachers' => $teachers
        ]);
    }

    public function update(Project $project, ProjectRequest $request)
    {
        $response = $this->projectService->handleUpdate($project, $request);
        if ($response['success']) {
            return redirect()->route('student.projects.index')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function deleteFile(Document $document)
    {
        $filePath = $document->file_path;
        try {
            DB::beginTransaction();
            Storage::delete($filePath);
            $document->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa file thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xóa file thất bại');
        }
    }

    public function showProjectOfStudent(Project $project)
    {
        return view('teachers.projects.detail', [
            'project' => $project
        ]);
    }

    public function download(Document $document)
    {
        $filename = $document->name;
        $path = $document->file_path;

        return Storage::download($path, $filename);
    }
}
