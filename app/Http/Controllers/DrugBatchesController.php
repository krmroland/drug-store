<?php

namespace App\Http\Controllers;

use App\Drug;
use Illuminate\Http\Request;

class DrugBatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Drug $drug, Request $request)
    {
        return $drug->addBatch($request->validate([
            'expires_at'=>'required|date',
            'recorded_at'=>'required|date',
            'unit_price'=>'required|numeric',
            'quantity'=>'required|numeric',
        ]));
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
    }
}
