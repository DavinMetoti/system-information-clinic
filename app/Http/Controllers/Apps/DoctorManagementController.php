<?php

namespace App\Http\Controllers\Apps;

use App\Http\Contracts\Auth\RegisterDoctorRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apps\Doctor\StoreRequest;
use App\Http\Requests\Apps\Doctor\UpdateRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorManagementController extends Controller
{
    protected $doctorRepository;

    /**
     * Create a new controller instance.
     *
     * @param DoctorRepositoryInterface $doctorRepository
     */
    public function __construct(RegisterDoctorRepositoryInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    public function index()
    {
        return view('pages.content.doctor-management.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.content.doctor-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = 'dokter';

        try {
            $result = $this->doctorRepository->register($validated);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User successfully registered!',
                ], Response::HTTP_CREATED);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User registration failed!',
                    'error' => $result['message'],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User registration failed!',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = $this->doctorRepository->find($id);
        $specializations = Specialization::all();

        if (!$doctor) {
            return redirect()->route('doctor-management.index')->with('error', 'Doctor not found.');
        }

        return view('pages.content.doctor-management.edit', compact('doctor', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        try {
            $result = $this->doctorRepository->update($id, $validated);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Doctor successfully updated!',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor update failed!',
                    'error' => $result['message'],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the doctor.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $result = $this->doctorRepository->delete($id);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Doctor successfully deleted!',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor deletion failed!',
                    'error' => $result['message'],
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the doctor.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get datatable of doctors.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of doctors.
     */
    public function datatable(Request $request)
    {
        return $this->doctorRepository->datatable($request);
    }


}
