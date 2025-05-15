<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface SupplierRepositoryInterface
{
    /**
     * Store a new supplier.
     *
     * @param array $data
     * @return \App\Models\Supplier
     */
    public function store(array $data);

    /**
     * Update an existing supplier.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Supplier
     */
    public function update(int $id, array $data);

    /**
     * Delete a supplier.
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
     * Find a supplier by ID.
     *
     * @param int $id
     * @return \App\Models\Supplier|null
     */
    public function find(int $id);

    /**
     * Get limited supplier with optional search.
     *
     * @param string $search
     * @return \Illuminate\Support\Collection
     */
    public function getLimitedWithSearch(?string $search = null);
}
