<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableStoreRequest $request)
    {
        $requestData = $request->validated();
    
        // Retrieve the first element of the status and location arrays
        $status = is_array($requestData['status']) ? reset($requestData['status']) : $requestData['status'];
        $location = is_array($requestData['location']) ? reset($requestData['location']) : $requestData['location'];
    
        Table::create([
            'name' => $requestData['name'],
            'guest_number' => $requestData['guest_number'],
            'status' => $status,
            'location' => $location,
        ]);
    
        return redirect()->route('admin.tables.index')->with('success', 'Table created successfully');
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
    public function edit(Table $table)
    {
        return view('admin.tables.edit',compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableStoreRequest $request, Table $table)
    {
        $table->update($request->validated());
        return to_route('admin.tables.index')->with('success', 'Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table->reservation()->delete();
        $table->delete();
        return to_route('admin.tables.index')->with('danger', 'Table deleted successfully');
    }
}
