<?php

namespace App\Http\Controllers;

use App\Drug;
use Illuminate\Http\Request;

class DrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Drug::withQuantities();
        return Drug::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|unique:drugs|min:2|max:100']);

        $drug = Drug::create($data);

        return $drug;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Drug $drug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        $drug->load('batches');

        return $drug;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Drug $drug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Drug                $drug
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Drug $drug
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();

        return response()->json('Drug was deleted successfully');
    }
}
