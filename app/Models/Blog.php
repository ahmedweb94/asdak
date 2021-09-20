<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getImageUrlAttribute()
    {
        return url('storage/app/public/'.$this->image);
    }

    public function getProjectImageUrlAttribute()
    {
        return url('storage/app/public/'.$this->project_image);
    }
}
