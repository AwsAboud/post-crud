<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    /**
     * Get all records
     * 
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(): Collection|LengthAwarePaginator;

    /**
     * Find record by ID
     * 
     * @param int $id
     * @return Post|null
     */
    public function findById(int $id): ?Post;

    /**
     * Create new record
     * 
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post;

    /**
     * Update existing record
     * 
     * @param int $id
     * @param array $data
     * @return Post|null
     */
    public function update(int $id, array $data): ?Post;

    /**
     * Delete record by ID
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
} 