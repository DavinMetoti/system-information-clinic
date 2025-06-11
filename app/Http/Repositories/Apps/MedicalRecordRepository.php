<?php

namespace App\Http\Repositories\Apps;

use App\Http\Contracts\Apps\MedicalRecordRepositoryInterface;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MedicalRecordRepository implements MedicalRecordRepositoryInterface
{
    /**
     * Create a new medical record.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        try {
            $medicalRecord = MedicalRecord::create([
                'user_id'      => $data['user_id'],
                'doctor_id'    => $data['doctor_id'],
                'date'         => $data['date'],
                'complaint'    => $data['complaint'] ?? null,
                'diagnosis'    => $data['diagnosis'] ?? null,
                'treatment'    => $data['treatment'] ?? null,
                'notes'        => $data['notes'] ?? null,
                'prescription' => $data['prescription'] ?? null,
                'status'       => $data['status'],
            ]);
            return [
                'status' => 'success',
                'message' => 'Medical record created successfully.',
                'data' => $medicalRecord
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get all medical records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return MedicalRecord::all();
    }

    /**
     * Get datatable of medical records.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of medical records.
     */
    public function datatable(Request $request)
    {
        $query = MedicalRecord::with('doctor');

        if ($request->has('patient_id') && $request->patient_id) {
            $query->where('user_id', $request->patient_id);
        }

        if ($request->has('doctor_id') && $request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                return '
                    <button class="btn btn-sm btn-warning edit-record" data-id="' . $record->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-record" data-id="' . $record->id . '">Delete</button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Find a medical record by ID.
     *
     * @param int $id Medical record ID.
     * @return MedicalRecord|null Medical record instance or null if not found.
     */
    public function find($id): ?MedicalRecord
    {
        return MedicalRecord::find($id);
    }

    /**
     * Update the specified medical record.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        $medicalRecord = $this->find($id);
        if ($medicalRecord) {
            $medicalRecord->update([
                'user_id'      => $data['user_id'],
                'doctor_id'    => $data['doctor_id'],
                'date'         => $data['date'],
                'complaint'    => $data['complaint'] ?? null,
                'diagnosis'    => $data['diagnosis'] ?? null,
                'treatment'    => $data['treatment'] ?? null,
                'notes'        => $data['notes'] ?? null,
                'prescription' => $data['prescription'] ?? null,
                'status'       => $data['status'],
            ]);
            return ['status' => 'success', 'message' => 'Medical record updated successfully.'];
        }
        return ['status' => 'error', 'message' => 'Medical record not found.'];
    }

    /**
     * Delete the specified medical record.
     *
     * @param int $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $medicalRecord = MedicalRecord::find($id);
            if ($medicalRecord) {
                $medicalRecord->delete();
                return [
                    'status' => 'success',
                    'message' => 'Medical record deleted successfully.',
                    'data' => null
                ];
            }
            return [
                'status' => 'error',
                'message' => 'Medical record not found.',
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
}
