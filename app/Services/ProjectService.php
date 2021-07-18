<?php

namespace App\Services;

use App\Notifications\StudentSubmitProjectNotification;
use App\Repositories\DocumentRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ProjectService extends BaseService
{
    protected $projectRepository;
    protected $documentRepository;

    public function __construct(ProjectRepository $projectRepository, DocumentRepository $documentRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->documentRepository = $documentRepository;
    }

    public function handleStore($request)
    {
        try {
            $projectData = $request->only(['name', 'subject', 'description', 'teacher_id']);
            $projectData['student_id'] = getLoggedInUser()->accountable_id;
            DB::beginTransaction();
            $project = $this->projectRepository->create($projectData);
            if ($project->id) {
                $documents = $request->file('documents');
                foreach ($documents as $document) {
                    $uploadFileResponse = $this->handleUploadFile($document, $project);
                    if (!$uploadFileResponse) {
                        return $this->sendError('Tạo đồ án không thành công, vui lòng thử lại');
                    }
                }
                DB::commit();
                Notification::send($project->teacher->account, new StudentSubmitProjectNotification($project));
                return $this->sendResponse('Tạo đồ án thành công');
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function handleUpdate($project, $request)
    {
        try {
            $projectData = $request->only(['name', 'subject', 'description', 'teacher_id']);
            tap($project)->update($projectData);
            $documents = $request->file('documents');
            foreach ($documents as $document) {
                $uploadFileResponse = $this->handleUploadFile($document, $project);
                if (!$uploadFileResponse) {
                    return $this->sendError('Sửa đồ án không thành công, vui lòng thử lại');
                }
            }
            DB::commit();
            return $this->sendResponse('Sửa đồ án thành công');
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    private function handleUploadFile($document, $project)
    {
        $filename = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $document->getClientOriginalExtension();
        $studentId = $project->student_id;
        $studentName = getAccountInfo()->name;
        $teacherId = $project->teacher_id;
        $teacherName = $project->teacher->name;
        $folder = "projects/{$studentId}-{$studentName}/{$teacherId}-{$teacherName}";
        $filePath = $folder . '/' . $filename . '-' . time() . '.' . $extension;
        Storage::put($filePath, file_get_contents($document), 'public');
        if (!Storage::exists($filePath)) {
            return false;
        }
        $documentData = [
            'name' => $filename . '.' . $extension,
            'file_path' => $filePath,
            'file_size' => $document->getSize(),
            'file_mime' => $document->getMimeType(),
            'project_id' => $project->id
        ];
        $document = $this->documentRepository->create($documentData);
        if (!$document->id) {
            return false;
        }
        return true;
    }
}
