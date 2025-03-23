<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return view('dashboard')->with(['stores' => $stores]);
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        Store::create($request->all());
        return redirect()->route('stores.index')->with('success', 'Store added successfully!');
    }

    public function edit(string $id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.edit')->with(['store' => $store]);
    }

    public function update(StoreRequest $request, string $id)
    {
        Store::findOrFail($id)->update($request->all());
        return redirect()->route('stores.index')->with('success', 'Store updated successfully!');
    }

    public function destroy(string $id)
    {
        Store::findOrFail($id)->delete();
        return redirect()->route('stores.index')->with('success', 'Store deleted successfully!');
    }
}
