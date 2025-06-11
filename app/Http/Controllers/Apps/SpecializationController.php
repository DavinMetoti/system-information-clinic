<?php

namespace App\Http\Controllers\Apps;

use App\Http\Contracts\Apps\SpecializationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apps\Specialization\StoreRequest;
use App\Http\Requests\Apps\Specialization\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecializationController extends Controller
{
    protected $specializationRepository;

    /**
     * Create a new controller instance.
     *
     * @param SpecializationRepositoryInterface $specializationRepository
     * @return void
     */
    public function __construct(SpecializationRepositoryInterface $specializationRepository)
    {
        $this->specializationRepository = $specializationRepository;
    }

    /**
     * Display a listing of the specializations.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->specializationRepository->getAll();
        }

        return view('pages.content.specialization.index');
    }

    /**
     * Show the form for creating a new specialization.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.content.specialization.create');
    }

    /**
     * Store a newly created specialization in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        try {
            $result = $this->specializationRepository->create($validated);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization successfully created!',
                ], Response::HTTP_CREATED);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Specialization creation failed!',
                    'error' => $result['message'],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the specialization.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified specialization.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $specialization = $this->specializationRepository->find($id);

        if (!$specialization) {
            return redirect()->route('specialization.index')->with('error', 'Specialization not found.');
        }

        return view('pages.content.specialization.edit', compact('specialization'));
    }

    /**
     * Update the specified specialization in storage.
     *
     * @param UpdateRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        try {
            $result = $this->specializationRepository->update($id, $validated);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization successfully updated!',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Specialization update failed!',
                    'error' => $result['message'],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the specialization.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified specialization from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        try {
            $result = $this->specializationRepository->delete($id);

            if ($result['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization deleted successfully.',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $result['message'] ?? 'Specialization deletion failed.',
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the specialization.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get datatable of specializations.
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        return $this->specializationRepository->datatable($request);
    }

    /**
     * Get limited specializations for select2 or similar search.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function select(Request $request)
    {
        try {
            $search = $request->get('search', '');
            $specializations = $this->specializationRepository->getLimitedWithSearch($search);

            $results = collect($specializations)->map(function ($specialization) {
                return [
                    'id' => $specialization->id,
                    'text' => $specialization->name,
                ];
            });

            return response()->json([
                'results' => $results
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
