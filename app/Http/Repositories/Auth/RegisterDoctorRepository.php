<?php

namespace App\Http\Repositories\Auth;

use App\Http\Contracts\Auth\RegisterDoctorRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RegisterDoctorRepository implements RegisterDoctorRepositoryInterface
{
    /**
     * Handle the user registration.
     */
    public function register(array $data)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => \Illuminate\Support\Facades\Hash::make($data['password']),
                'contact'   => $data['contact'] ?? null,
                'address'   => $data['address'] ?? null,
                'gender'    => $data['gender'] ?? null,
            ]);

            $user->assignRole('dokter');

            $registration_number = (string)(time() . '000' . $user->id);

            $user->doctor()->create([
                'registration_number'   => $registration_number,
                'specialization_id'     => $data['specialization'] ?? null,
                'license_number'        => $data['license_number'] ?? null,
            ]);

            DB::commit();

            return [
                'status'  => 'success',
                'message' => 'User created successfully'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];
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
        $query = User::with('doctor.specialization');

        $query->whereHas('roles', function ($q) {
            $q->where('name', 'dokter');
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

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        return User::with('doctor.specialization')->findOrFail($id);
    }

    /**
     * Update the specified user.
     */
    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $userUpdate = [];
            foreach (['name', 'email', 'contact', 'address', 'gender'] as $field) {
                if (array_key_exists($field, $data) && $data[$field] !== null && $data[$field] !== '') {
                    $userUpdate[$field] = $data[$field];
                }
            }
            if (!empty($userUpdate)) {
                $user->update($userUpdate);
            }

            if (isset($data['role'])) {
                $user->syncRoles([$data['role']]);
            }

            if ($user->doctor) {
                $doctorUpdate = [];
                if (
                    (isset($data['specialization_id']) && $data['specialization_id'] !== null && $data['specialization_id'] !== '') ||
                    (array_key_exists('specialization_id', $data) && $data['specialization_id'] !== null && $data['specialization_id'] !== '')
                ) {
                    $doctorUpdate['specialization_id'] = $data['specialization_id'];
                }
                if (array_key_exists('license_number', $data) && $data['license_number'] !== null && $data['license_number'] !== '') {
                    $doctorUpdate['license_number'] = $data['license_number'];
                }
                if (!empty($doctorUpdate)) {
                    $user->doctor->update($doctorUpdate);
                }
            }

            DB::commit();

            return [
                'status'  => 'success',
                'message' => 'User updated successfully'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete the specified user.
     */
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return [
                'status'  => 'success',
                'message' => 'User deleted successfully'
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to delete user: ' . $e->getMessage());
            return [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
