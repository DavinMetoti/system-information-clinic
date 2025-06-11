<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface SpecializationRepositoryInterface
{
    /**
     * Create a new specialization.
     *
     * @param array $data Data for the new specialization.
     * @return mixed Newly created specialization instance or identifier.
     */
    public function create(array $data);

    /**
     * Get all specializations.
     *
     * @return mixed List of all specializations.
     */
    public function getAll();

    /**
     * Get datatable of specializations.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of specializations.
     */
    public function datatable(Request $request);

    /**
     * Find a specialization by ID.
     *
     * @param int $id Specialization ID.
     * @return mixed Specialization instance or null if not found.
     */
    public function find($id);

    /**
     * Update the specified specialization.
     *
     * @param int $id Specialization ID.
     * @param array $data Data to update the specialization.
     * @return array Updated specialization data.
     */
    public function update($id, array $data);

    /**
     * Delete the specified specialization.
     *
     * @param int $id Specialization ID.
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
