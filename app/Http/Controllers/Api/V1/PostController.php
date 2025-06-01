<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    /**
     * Display a listing of the posts.
     */
    public function index(): JsonResponse
    {
        $posts = $this->postRepository->getAll();

        return $this->successResponse(PostResource::collection($posts));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = $this->postRepository->create($request->validated());
        
        if (!$post) {
            return $this->errorResponse('Post not found', 404);
        }
        
        return $this->successResponse(new PostResource($post), code:201);
    }

    /**
     * Display the specified post.
     */
    public function show(int $id): JsonResponse
    {
        $post = $this->postRepository->findById($id);

        if (!$post) {
            return $this->errorResponse('Post not found', 404);
        }

        return $this->successResponse(new PostResource($post));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        $post = $this->postRepository->update($id, $request->validated());

        if (!$post) {
            return $this->errorResponse('Post not found', 404);
        }

        return $this->successResponse(new PostResource($post));
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->postRepository->delete($id);

        if (!$deleted) {
            return $this->errorResponse('Post not found', 404);
        }

        return $this->successResponse(null, code:204);
    }
} 