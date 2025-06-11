<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientRepository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Http\Contracts\Apps\PatientRepositoryInterface $patientRepository
     */
    public function __construct(\App\Http\Contracts\Apps\PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.content.patients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = $this->patientRepository->findPatientById($id);

        if (!$patient) {
            return view('pages.content.patients.index');
        }

        return view('pages.content.patients.show', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function datatable(Request $request)
    {
        return $this->patientRepository->datatable($request);
    }
}
