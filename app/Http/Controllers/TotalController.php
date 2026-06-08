<?php

namespace App\Http\Controllers;

use App\Models\Total;
use Illuminate\Http\Request;

class TotalController extends Controller
{
    
    public function session_check()
    {
         if(!empty( activeSession()->id)){
           return  activeSession()->id;
        };
        return "Active Academic Session not found";
    }


    public function index()
    {
        $totals = Total::all();

        return response()->json([
            "status" => true,
            'data' => $totals
        ]);
    }

    public function testingPage()
    {
        return view('Frontend/Normal/Admin_Pages/test');
    }


    public function create() {}


    public function store(Request $request)
    {
        $createdTotal = Total::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            "status" => true,
            'data' => $createdTotal
        ]);
    }


    public function show(Total $total)
    {
        //
    }

  
    public function edit(Total $total)
    {
        //
    }


    public function update(Request $request, Total $total)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Total $total)
    {
        //
    }
}
