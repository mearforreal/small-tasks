<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $fields = $request->validate([
            'message' => 'required',
            'application_id' => 'required',

        ]);
        return Reply::create([
            'message' => $fields['message'],
            'application_id' => $fields['application_id'],
            'user_id' => $user_id,
        ]);
    }
}
