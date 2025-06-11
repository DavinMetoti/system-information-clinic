<?php

namespace App\Http\Contracts\Apps;

use Illuminate\Http\Request;

interface PatientRepositoryInterface
{
    /**
     * Get all patients.
     *
     * @return mixed List of all patients.
     */
    public function getAllPatients();

    /**
     * Find a patient by ID.
     *
     * @param int $id Patient ID.
     * @return mixed Patient instance or null if not found.
     */
    public function findPatientById(int $id);

    /**
     * Update an existing patient.
     *
     * @param int $id Patient ID.
     * @param array $data Data to update the patient.
     * @return mixed Updated patient data.
     */
    public function updatePatient(int $id, array $data);

    /**
     * Delete a patient.
     *
     * @param int $id Patient ID.
     * @return mixed Result of the delete operation.
     */
    public function deletePatient(int $id);

    /**
     * Get datatable of patients.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of patients.
     */
    public function datatable(Request $request);
}
