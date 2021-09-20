<?php

namespace App\Http\Resources;


class UserResource extends BaseResource
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
            'name' => $this->name,
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'age' => $this->age,
            'address' => $this->address,
            'short_description' => $this->short_description,
            'education_degree' => $this->education_degree,
            'verification_code' => $this->verification_code,
        ];
    }
}
