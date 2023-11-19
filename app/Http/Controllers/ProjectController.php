<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /** @var ProjectService */
    public ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['payload' => ProjectResource::collection(Project::all())]);
    }

    /**
     * Store a newly created resource in storage.
     * @param ProjectStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProjectStoreRequest $request): JsonResponse
    {
        $newProject = Project::query()->create($request->validated());

        return new JsonResponse(['payload' => ProjectResource::make($newProject)]);
    }

    /**
     * Display the specified resource.
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        return new JsonResponse([ 'payload' => ProjectResource::make($project)]);
    }

    /**
     * Update the specified resource in storage.
     * @param ProjectUpdateRequest $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(ProjectUpdateRequest $request, Project $project): JsonResponse
    {
        $validatedRequest = $request->validated();
        $project->update(
            [
                'name' => $validatedRequest['name'] ?? $project->name,
                'company_id' => $validatedRequest->company_id ?? $project->company_id,
            ]
        );

        return new JsonResponse(['payload' => ProjectResource::make($project)]);
    }

    /**
     * Remove the specified resource from storage.
     * @param Project $project
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return new JsonResponse([]);
    }
}
