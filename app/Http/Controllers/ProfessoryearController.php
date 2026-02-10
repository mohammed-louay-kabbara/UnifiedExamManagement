<?php

namespace App\Http\Controllers;

use App\Models\professor_year;
use App\Models\year;
use App\Models\User;
use App\Models\exam_cycles;
use Illuminate\Http\Request;


class ProfessoryearController extends Controller
{

    public function index()
    {
        $years=year::get();
        $professors=User::where('role',2)->get();
        $exam_cycles=exam_cycles::get();
        return view('admin.Professoryear',compact('years','professors','exam_cycles'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    $request->validate([
            'professor_id'   => 'required|exists:users,id',
            'exam_cycle_id'  => 'required|exists:exam_cycles,id',
            'years'          => 'required|array',
        ]);

        professor_year::where('professor_id', $request->professor_id)
            ->where('exam_cycle_id', $request->exam_cycle_id)
            ->delete();

        foreach ($request->years as $year) {
            professor_year::create([
                'professor_id'  => $request->professor_id,
                'exam_cycle_id' => $request->exam_cycle_id,
                'year_id'       => $year,
            ]);
        }

        return back()->with('alert', 'تم تحديث تكليف الأستاذ بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(professor_year $professor_year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(professor_year $professor_year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, professor_year $professor_year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(professor_year $professor_year)
    {
        //
    }
}
