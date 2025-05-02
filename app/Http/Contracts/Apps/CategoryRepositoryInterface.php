<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    /**
     * Store a new category.
     *
     * @param array $data
     * @return \App\Models\category
     */
    public function store(array $data);

    /**
     * Update an existing category.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\category
     */
    public function update(int $id, array $data);

    /**
     * Delete a category.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);

    /**
     * Get datatable data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function datatable(Request $request);

    /**
     * Find a category by ID.
     *
     * @param int $id
     * @return \App\Models\category|null
     */
    public function find(int $id);
}
