<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
 
        //transforms the resource into an array made up of the attributes to be converted to JSON
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'body'=>$this->body,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'user' => $this->user,
        ];

    }
    public function with($request){
        return[
            'version' => "1.0.0",
            'author' =>"Mikkycody",
        ];
    }
}
