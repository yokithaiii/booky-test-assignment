<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResource
    {
        $status = $request->input('status');
        $sortBy = $request->input('sort_by', 'asc');
        $perPage = $request->input('per_page', 1);

        $query = Task::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($sortBy) {
            $query->orderBy('created_at', $sortBy);
        }

        $tasks = $query->paginate($perPage);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $task = Task::create($validatedData);

        return response()->json([
            'message' => 'task successfully created.',
            'data' => new TaskResource($task),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource|JsonResponse
    {
        $task = Task::query()
            ->where('id', $id)
            ->first();

        if (!$task) {
            return response()->json(['error' => 'task not found.'], 404);
        }

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id): JsonResponse
    {
        $task = Task::query()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return response()->json(['error' => 'task not found.'], 404);
        }

        $validatedData = $request->validated();

        $task->update($validatedData);

        return response()->json([
            'message' => 'task successfully updated.',
            'data' => new TaskResource($task)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $task = Task::query()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return response()->json(['error' => 'task not found.'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'task successfully deleted.'], 200);
    }
}
