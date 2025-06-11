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
                'patient_id' => $data['patient_id'],
                'doctor_id' => $data['doctor_id'],
                'description' => $data['description'] ?? null,
                'slug' => $data['slug'],
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
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        $query = MedicalRecord::query();

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
     * @param int $id
     * @return MedicalRecord|null
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
                'patient_id' => $data['patient_id'],
                'doctor_id' => $data['doctor_id'],
                'description' => $data['description'] ?? null,
                'slug' => Str::slug($data['name']),
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
