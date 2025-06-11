<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Contracts\Auth\RegisterRepositoryInterface;
use App\Http\Requests\Auth\Register\StoreRequest;
use App\Http\Requests\Auth\Register\UpdateRequest;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    protected $registerRepository;

    /**
     * Create a new controller instance.
     *
     * @param RegisterRepositoryInterface $registerRepository
     * @return void
     */
    public function __construct(RegisterRepositoryInterface $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }


    /**
     * Show the user list.
     */
    public function index()
    {
        return view('auth.register.index');
    }

    /**
     * Handle user registration request.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = 'pasien';

        try {
            $result = $this->registerRepository->register($validated);

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
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $roles = Role::all();
        return view('pages.content.register.create',
            ['roles' => $roles]
        );
    }

    /**
     * Get datatable of users.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request) {
        return $this->registerRepository->datatable($request);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->registerRepository->find($id);
        $roles = Role::all();

        return view('pages.content.register.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $user = $this->registerRepository->update($id, $validated);

            return response()->json([
                'message' => 'User successfully updated!',
                'user' => $user,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User update failed!',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->registerRepository->delete($id);

            return response()->json([
                'message' => 'User successfully deleted!',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User deletion failed!',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
