<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Role;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $categoryId = $request->input('category_id'); // Get the category_id from the request

        $applications = $this->applicationService->filter($user, $categoryId);

        return response()->json($applications);
    }

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
            'title' => 'required',
            'category_id' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:35000'

        ]);

        $image = '';
        if ($request->hasFile('image')) {
            $request->image->store('requests', 'public');
            $image = $request->image->hashName();
        }
        return Application::create([
            'title' => $fields['title'],
            'category_id' => $fields['category_id'],
            'subject' => $fields['subject'],
            'message' => $fields['message'],
            'user_id' => $user_id,
            'image' => $image,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Application::findOrFail($id)->with('cateory')->with('user')->with('replies');
    }

    /**
     * Display the image file.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function image($fileName)
    {
        $path = storage_path() . '/app/public/requests/' . $fileName;
        return response()->download($path);
    }
}
