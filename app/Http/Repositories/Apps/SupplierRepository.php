<?php

namespace App\Http\Repositories\Apps;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Contracts\Apps\SupplierRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;


class SupplierRepository implements SupplierRepositoryInterface
{
    public function store(array $data)
    {

        $data['created_by'] = Auth::user()->name;
        $data['is_active'] = $data['is_active'] ?? 1;

        return Supplier::create($data);
    }

    public function update(int $id, array $data)
    {
        $supplier = Supplier::findOrFail($id);

        $data['updated_by'] = Auth::user()->name;

        $supplier->update($data);

        return $supplier;
    }

    public function delete(int $id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->logo && Storage::disk('public')->exists($supplier->logo)) {
            Storage::disk('public')->delete($supplier->logo);
        }

        return $supplier->delete();
    }

    public function datatable(Request $request)
    {
        $query = Supplier::query();

        return DataTables::of($query)
            ->order(function ($query) use ($request) {
                $columns = $request->columns ?? [];
                $order = $request->order ?? [];

                if (is_array($order)) {
                    foreach ($order as $orderItem) {
                        $columnIndex = $orderItem['column'] ?? null;
                        $dir = $orderItem['dir'] ?? 'asc';

                        // Ensure the column index is valid and has a non-null 'data' field
                        if (isset($columns[$columnIndex]['data']) && $columns[$columnIndex]['data'] !== null) {
                            $column = $columns[$columnIndex]['data'];
                            $query->orderBy($column, $dir);
                        }
                    }
                }
            })
            ->make(true);
    }

    public function find(int $id)
    {
        return Supplier::find($id);
    }

    public function getLimitedWithSearch(?string $search = '')
    {
        $query = Supplier::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->limit(10)->get();
    }
}
