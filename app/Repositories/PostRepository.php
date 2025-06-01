<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * Get all records
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(): Collection|LengthAwarePaginator
    {
        return $this->model->paginate(10);
    }

    /**
     * Find record by ID
     *
     * @param int $id
     * @return Post|null
     */
    public function findById(int $id): ?Post
    {
        return $this->model->find($id);
    }

    /**
     * Create new record
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

    /**
     * Update existing record
     *
     * @param int $id
     * @param array $data
     * @return Post|null
     */
    public function update(int $id, array $data): ?Post
    {
        $post = $this->findById($id);
        
        if (!$post) {
            return null;
        }

        $post->update($data);
        return $post;
    }

    /**
     * Delete record by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $post = $this->findById($id);
        
        if (!$post) {
            return false;
        }

        return $post->delete();
    }
} 