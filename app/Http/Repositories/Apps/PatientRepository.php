<?php

namespace App\Http\Repositories\Apps;

use App\Http\Contracts\Apps\PatientRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PatientRepository implements PatientRepositoryInterface
{
    /**
     * Get all patients.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPatients()
    {
        return User::where('role', 'pasien')->get();
    }

    /**
     * Find a patient by ID.
     *
     * @param int|string $id
     * @return User|null
     */
    public function findPatientById($id): ?User
    {
        return User::where('role', 'pasien')->find($id);
    }

    /**
     * Update the specified patient.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function updatePatient(int $id, array $data): array
    {
        $patient = $this->findPatientById($id);
        if ($patient) {
            $patient->update($data);
            return ['status' => 'success', 'message' => 'Patient updated successfully.'];
        }
        return ['status' => 'error', 'message' => 'Patient not found.'];
    }

    /**
     * Delete the specified patient.
     *
     * @param int $id
     * @return array
     */
    public function deletePatient(int $id): array
    {
        try {
            $patient = $this->findPatientById($id);
            if ($patient) {
                $patient->delete();
                return [
                    'status' => 'success',
                    'message' => 'Patient deleted successfully.',
                    'data' => null
                ];
            }
            return [
                'status' => 'error',
                'message' => 'Patient not found.',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Handle the user datatable.
     */
    public function datatable(Request $request)
    {
        $query = User::with('pasien');

        $query->whereHas('roles', function ($q) {
            $q->where('name', 'pasien');
        });

        foreach ($request->all() as $key => $value) {
            if (!empty($value) && in_array($key, ['name', 'email', 'role'])) {
                if ($key === 'role') {
                    $query->whereHas('roles', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                } else {
                    $query->where($key, 'like', "%{$value}%");
                }
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                return $user->getRoleNames()->implode(', ');
            })
            ->addColumn('actions', function ($user) {
                return '
                    <button class="btn btn-sm btn-warning edit-user" data-id="' . $user->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-user" data-id="' . $user->id . '">Delete</button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
