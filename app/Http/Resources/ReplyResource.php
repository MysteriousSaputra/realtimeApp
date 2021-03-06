<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $liked = empty(auth()) ? auth()->id : 0 ;
        return [
            'id'=> $this->id,
            'reply'=> $this->body,
            'name'=> $this->user->name,
            'quetion'=> $this->quetion->slug,
            'user_id'=> $this->user_id,
            'quetion_slug'=> $this->quetion->slug,
            'like_count'=> $this->like->count(),
            'liked'=> $this->like->where('user_id', $liked)->count(),
            'created_at'=> $this->created_at->diffForHumans(),
            'auth'=> auth()
        ];
    }
}
