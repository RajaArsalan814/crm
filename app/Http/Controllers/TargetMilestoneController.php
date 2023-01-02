<?php

namespace App\Http\Controllers;

use App\Models\TargetMilestone;
use Illuminate\Http\Request;

class TargetMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $milestone = TargetMilestone::where('user_id', '=', Auth()->user()->id)->get();
        return view('admin.targets.view', compact('milestone'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TargetMilestone  $targetMilestone
     * @return \Illuminate\Http\Response
     */
    public function show(TargetMilestone $targetMilestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TargetMilestone  $targetMilestone
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetMilestone $targetMilestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TargetMilestone  $targetMilestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TargetMilestone $targetMilestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TargetMilestone  $targetMilestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetMilestone $targetMilestone)
    {
        //
    }
}