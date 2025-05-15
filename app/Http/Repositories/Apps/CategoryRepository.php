<?php

namespace App\Http\Repositories\Apps;

use App\Http\Contracts\Apps\CategoryRepositoryInterface;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function store(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);

        $category->update($data);

        return $category;
    }

    public function delete(int $id)
    {
        $category = Category::findOrFail($id);


        return $category->delete();
    }

    public function datatable(Request $request)
    {
        $query = Category::query();

        return DataTables::of($query)
            ->make(true);
    }

    public function find(int $id)
    {
        return Category::find($id);
    }

    public function getLimitedWithSearch(?string $search = '')
    {
        $query = Category::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->limit(10)->get();
    }
}
