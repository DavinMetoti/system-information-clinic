<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface MedicalRecordRepositoryInterface
{
    /**
     * Create a new medical record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get all medical records.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get datatable of medical records.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request);

    /**
     * Find a medical record by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Update the specified medical record.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data);

    /**
     * Delete the specified medical record.
     *
     * @param int $id
     * @return void
     */
    public function delete($id);
}
