<?php

namespace App\Http\Controllers\SuperAdmin\Broadcast;

use App\Http\Controllers\Controller;

use App\Models\SuperAdmin\Broadcast\BroadcastView;
use Illuminate\Http\Request;

class BroadcastViewController extends Controller
{

    public function index()
    {
        return view('SuperAdmin.Pages.Broadcast.broadcast_list');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(BroadcastView $broadcastView)
    {
        //
    }


    public function edit(BroadcastView $broadcastView)
    {
        //
    }


    public function update(Request $request, BroadcastView $broadcastView)
    {
        //
    }


    public function destroy(BroadcastView $broadcastView)
    {
        //
    }
}
