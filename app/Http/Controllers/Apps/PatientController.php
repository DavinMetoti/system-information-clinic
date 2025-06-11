<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\UpdateRequest;
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
     * Display the specified patient.
     *
     * @param int $id
     * @return \Illuminate\View\View
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
     * Update the specified patient in storage.
     *
     * @param UpdateRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $result = $this->patientRepository->updatePatient($id, $data);


            if ($result['status'] === 'error') {
                return redirect()->back()->with('error', $result['message']);
            }

            return redirect()->back()->with('success', $result['message']);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'An error occurred while updating the patient.');
        }
    }

    /**
     * Remove the specified patient from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            $deleted = $this->patientRepository->deletePatient($id);
            if (!$deleted) {
                return redirect()->route('apps.profile.index')->with('error', 'Patient not found or could not be deleted.');
            }
            return redirect()->route('apps.profile.index')->with('success', 'Patient deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('apps.profile.index')->with('error', 'An error occurred while deleting the patient.');
        }
    }

    /**
     * Get datatable of patients.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        return $this->patientRepository->datatable($request);
    }
}
