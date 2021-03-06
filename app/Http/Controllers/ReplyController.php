<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Quetion;
use App\Notifications\NewReplyNotification;
use App\Http\Resources\ReplyResource;
use Illuminate\Http\Request;

class ReplyController extends Controller
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
    public function index(Quetion $quetion)
    {
        return ReplyResource::collection($quetion->replies);
        // return Reply::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Quetion $quetion, Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $reply = $quetion->replies()->create($request->all());
        $user = $quetion->user;
        $user->notify(new NewReplyNotification($reply));

        return response(['reply'=> new ReplyResource($reply)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Quetion $quetion, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Quetion $quetion, Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response(['reply'=> new ReplyResource($reply)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quetion $quetion, Reply $reply)
    {
        $reply->delete();
        return response(null, 204);
    }
}
