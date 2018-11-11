<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function general(Request $request)
    {
        $request->validate(['range'=>'required']);

        return Report::generate($request->range);
    }
}
