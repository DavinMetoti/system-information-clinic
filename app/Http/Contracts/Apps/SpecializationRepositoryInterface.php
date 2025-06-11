<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface SpecializationRepositoryInterface
{
    /**
     * Create a new specialization.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get all specializations.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get datatable of specializations.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request);

    /**
     * Find a specialization by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Update the specified specialization.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data);

    /**
     * Delete the specified specialization.
     *
     * @param int $id
     * @return void
     */
    public function delete($id);

    /**
     * Get limited specializations with search functionality.
     *
     * @param string|null $search
     * @return mixed
     */
    public function getLimitedWithSearch(?string $search = '');
}
