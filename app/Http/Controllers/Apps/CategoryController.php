<?php

namespace App\Http\Controllers\Apps;

use App\Http\Contracts\Apps\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apps\Category\StoreRequest;
use App\Http\Requests\Apps\Category\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryRepo;

    /**
     * Create a new controller instance.
     *
     * @param CategoryRepositoryInterface $categoryRepo
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.content.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        try {
            $category = $this->categoryRepo->store($validated);
            return response()->json([
                'message' => 'category successfully created!',
                'user' => $category,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'category create failed!',
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
        $category = $this->categoryRepo->find($id);
        return view('pages.content.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        try {
            $category = $this->categoryRepo->update($id, $validated);
            return response()->json([
                'message' => 'category successfully updated!',
                'category' => $category,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'category update failed!',
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
            $this->categoryRepo->delete($id);
            return response()->json([
                'message' => 'category successfully deleted!',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'category delete failed!',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function datatable(Request $request)
    {
        return $this->categoryRepo->datatable($request);
    }

    public function select(Request $request)
    {
        try {
            $search = $request->get('search', '');
            $categories = $this->categoryRepo->getLimitedWithSearch($search);

            $results = collect($categories)->map(function ($category) {
                return [
                    'id' => $category->id,
                    'text' => $category->name,
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
