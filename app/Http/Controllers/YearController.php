<?php

namespace App\Http\Controllers;

use App\Models\year;
use Illuminate\Http\Request;

class YearController extends Controller
{

    public function index()
    {
        $years = year::get();
        return view('admin.year',compact('years'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required',
        ]);
   
        year::create([
            'name' => $request->name,
        ]);
        return back()->with('alert', 'تم الحفظ بنجاح');
    }

    public function show(year $year)
    {
        //
    }

    public function edit(year $year)
    {
        //
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        year::where('id',$id)->update([
            'name' => $request->name,
        ]);
        return back()->with('alert', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        year::where('id',$id)->delete();
        return back()->with('alert', 'تم الحذف بنجاح');
    }
}
