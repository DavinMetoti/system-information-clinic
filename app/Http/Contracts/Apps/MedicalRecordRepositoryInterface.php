<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface MedicalRecordRepositoryInterface
{
    /**
     * Create a new medical record.
     *
     * @param array $data Data for the new medical record.
     * @return mixed Newly created medical record instance or identifier.
     */
    public function create(array $data);

    /**
     * Get all medical records.
     *
     * @return mixed List of all medical records.
     */
    public function getAll();

    /**
     * Get datatable of medical records.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of medical records.
     */
    public function datatable(Request $request);

    /**
     * Find a medical record by ID.
     *
     * @param int $id Medical record ID.
     * @return mixed Medical record instance or null if not found.
     */
    public function find($id);

    /**
     * Update the specified medical record.
     *
     * @param int $id Medical record ID.
     * @param array $data Data to update the medical record.
     * @return array Updated medical record data.
     */
    public function update($id, array $data);

    /**
     * Delete the specified medical record.
     *
     * @param int $id Medical record ID.
     * @return void
     */
    public function delete($id);
}
