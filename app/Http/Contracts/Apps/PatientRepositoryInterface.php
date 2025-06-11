<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface PatientRepositoryInterface
{
    /**
     * Get all patients.
     *
     * @return mixed
     */
    public function getAllPatients();

    /**
     * Find a patient by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function findPatientById(int $id);

    /**
     * Update an existing patient.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updatePatient(int $id, array $data);

    /**
     * Delete a patient.
     *
     * @param int $id
     * @return mixed
     */
    public function deletePatient(int $id);

    /**
     * Get datatable of patients.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request);
}
