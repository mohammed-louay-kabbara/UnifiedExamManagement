<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exam_centers;

class examcentersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam_centers=exam_centers::get();
        return view('admin.exam_centers',compact('exam_centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'governorate' => 'required',
            'location' => 'required',
            'amount' => 'required',
        ]);
        exam_centers::create([
            'name' => $request->name,
            'governorate' => $request->governorate,
            'location' => $request->location,
            'amount' => $request->amount
        ]);
        return back()->with('alert', 'تم الحفظ بنجاح');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'governorate' => 'required',
            'location' => 'required',
            'amount' => 'required'
        ]);
        exam_centers::where('id',$id)->update([
            'name' => $request->name,
            'governorate' => $request->governorate,
            'location' => $request->location,
            'amount' => $request->amount
        ]);
        return back()->with('alert', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        exam_centers::where('id',$id)->delete();
        return back()->with('alert', 'تم الحذف بنجاح');
    }
}
