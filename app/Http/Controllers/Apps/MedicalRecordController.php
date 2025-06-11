<?php

namespace App\Http\Controllers\Apps;

use App\Http\Contracts\Apps\MedicalRecordRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apps\MedicalRecord\StoreRequest;
use App\Http\Requests\Apps\MedicalRecord\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    protected $medicalRecordRepository;

    /**
     * MedicalRecordController constructor.
     *
     * @param MedicalRecordRepositoryInterface $medicalRecordRepository
     */
    public function __construct(MedicalRecordRepositoryInterface $medicalRecordRepository)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * Display a listing of the medical records.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.content.medical-records.index');
    }

    /**
     * Show the form for creating a new medical record.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $patientId = $request->query('patient_id');

        $doctor = auth()->user();
        return view('pages.content.medical-records.create', [
            'patient' => $patientId,
            'doctor' => $doctor,
        ]);
    }

    /**
     * Store a newly created medical record in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {

        $data['user_id'] = $request->query('patient_id') ?? $request->input('user_id') ?? auth()->user()->id;
        $data['doctor_id'] = auth()->id();

        $data = array_merge($request->validated(), $data);

        $data['prescription'] = $request->input('prescription');

        $result = $this->medicalRecordRepository->create($data);

        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'Medical record created successfully.',
                'data' => $result['data']
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message']
            ], 422);
        }
    }

    /**
     * Display the specified medical record.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $medicalRecord = $this->medicalRecordRepository->find($id);

        if (!$medicalRecord) {
            return redirect()->route('doctor.medical-record.index');
        }

        return view('pages.content.medical-records.show', compact('medicalRecord'));
    }

    /**
     * Show the form for editing the specified medical record.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $medicalRecord = $this->medicalRecordRepository->find($id);

        if (!$medicalRecord) {
            return redirect()->route('doctor.medical-record.index');
        }

        return view('pages.content.medical-records.edit', compact('medicalRecord'));
    }

    /**
     * Update the specified medical record in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $result = $this->medicalRecordRepository->update($id, $data);

        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message']
            ], 422);
        }
    }

    /**
     * Remove the specified medical record from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->medicalRecordRepository->delete($id);

        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message']
            ], 422);
        }
    }

    /**
     * Get datatable of medical records.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        return $this->medicalRecordRepository->datatable($request);
    }
}
