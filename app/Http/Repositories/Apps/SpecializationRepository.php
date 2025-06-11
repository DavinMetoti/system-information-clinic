<?php

namespace App\Http\Repositories\Apps;

use App\Http\Contracts\Apps\SpecializationRepositoryInterface;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SpecializationRepository implements SpecializationRepositoryInterface
{
    /**
     * Create a new specialization.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        try {
            $specialization = Specialization::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'slug' => $data['slug'],
            ]);
            return [
                'status' => 'success',
                'message' => 'Specialization created successfully.',
                'data' => $specialization
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get all specializations.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Specialization::all();
    }

    /**
     * Get datatable of specializations.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        $query = Specialization::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($user) {
                return '
                    <button class="btn btn-sm btn-warning edit-user" data-id="' . $user->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-user" data-id="' . $user->id . '">Delete</button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Find a specialization by ID.
     *
     * @param int $id
     * @return Specialization|null
     */
    public function find($id): ?Specialization
    {
        return Specialization::find($id);
    }

    /**
     * Update the specified specialization.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        $specialization = $this->find($id);
        if ($specialization) {
            $specialization->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'slug' => Str::slug($data['name']),
            ]);
            return ['status' => 'success', 'message' => 'Specialization updated successfully.'];
        }
        return ['status' => 'error', 'message' => 'Specialization not found.'];
    }

    /**
     * Delete the specified specialization.
     *
     * @param int $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $specialization = Specialization::find($id);
            if ($specialization) {
                $specialization->delete();
                return [
                    'status' => 'success',
                    'message' => 'Specialization deleted successfully.',
                    'data' => null
                ];
            }
            return [
                'status' => 'error',
                'message' => 'Specialization not found.',
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

    public function getLimitedWithSearch(?string $search = '')
    {
        $query = Specialization::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->limit(10)->get();
    }
}
