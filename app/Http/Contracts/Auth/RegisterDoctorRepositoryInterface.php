<?php

namespace App\Http\Contracts\Auth;

use Illuminate\Http\Request;

interface RegisterDoctorRepositoryInterface
{
    /**
     * Register a new doctor and assign a role to the doctor.
     *
     * @param array $data
     * @return array
     */
    public function register(array $data);

    /**
     * Get datatable of doctors.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request);

    /**
     * Find a doctor by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Update the specified doctor.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data);

    /**
     * Delete the specified doctor.
     *
     * @param int $id
     * @return void
     */
    public function delete($id);
}
