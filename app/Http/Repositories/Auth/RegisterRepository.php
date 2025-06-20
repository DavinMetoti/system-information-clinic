<?php

namespace App\Http\Repositories\Auth;

use App\Http\Contracts\Auth\RegisterRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class RegisterRepository implements RegisterRepositoryInterface
{
    /**
     * Handle the user registration.
     */
    public function register(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
                'contact' => $data['contact'] ?? null,
                'address' => $data['address'] ?? null,
                'gender' => $data['gender'] ?? null,
            ]);

            $user->assignRole('pasien');

            // Fix: pasien_number as string to avoid integer overflow
            $pasien_number = (string)(time() . '000' . $user->id);

            $user->pasien()->create([
                'pasien_number'   => $pasien_number,
                'date_of_birth'   => $data['date_of_birth'] ?? null,
                'place_of_birth'  => $data['place_of_birth'] ?? null,
                'blood_type'      => $data['blood_type'] ?? null,
                'bpjs_number'     => $data['bpjs_number'] ?? null,
            ]);

            return ['status' => 'success', 'message' => 'User created successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Get datatable of users.
     *
     * @param Request $request HTTP request containing datatable parameters.
     * @return mixed Datatable result of users.
     */
    public function datatable(Request $request)
    {
        $query = User::query();

        // Apply filters dynamically based on request input
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
        return User::findOrFail($id);
    }

    /**
     * Update the specified user.
     */
    public function update($id, array $data)
    {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if (isset($data['password']) && !empty($data['password'])) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            if (isset($data['role'])) {
                $user->syncRoles([$data['role']]);
            }

            return ['status' => 'success', 'message' => 'User updated successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
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
        } catch (\Exception $e) {
            throw new \Exception('Failed to delete user: ' . $e->getMessage());
        }
    }
}
