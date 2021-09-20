<?php

namespace App\Http\Resources;


class BlogResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'project_title' => $this->project_title,
            'project_description' => $this->project_description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'image' => $this->image_url,
            'project_image' => $this->project_image_url,
            'user'=>$this->whenLoaded('user',new UserResource($this->user)),
        ];
    }
}
