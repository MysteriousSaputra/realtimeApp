<?php

namespace App\Http\Controllers;

use App\Models\Quetion;
use Illuminate\Http\Request;
use App\Http\Resources\QuetionResource;

class QuetionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuetionResource::collection(Quetion::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quetion::create($request->all());
        return response('Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quetion  $quetion
     * @return \Illuminate\Http\Response
     */
    public function show(Quetion $quetion)
    {
        return new QuetionResource($quetion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quetion  $quetion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quetion $quetion)
    {
        $quetion->update($request->all());
        return response('updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quetion  $quetion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quetion $quetion)
    {
        $quetion->delete();
        return response(null, 204);
    }
}
