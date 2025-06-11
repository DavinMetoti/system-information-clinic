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

    public function __construct(MedicalRecordRepositoryInterface $medicalRecordRepository)
    {
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.content.medical-records.index');
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data['user_id'] = $request->query('patient_id') ?? $request->input('user_id') ?? auth()->user()->id;
        $data['doctor_id'] = auth()->id();

        $data = $request->validated();

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
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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

    public function datatable(Request $request)
    {
        return $this->medicalRecordRepository->datatable($request);
    }
}
