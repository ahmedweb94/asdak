<?php

namespace App\Repository;

use App\Helper\UploadImages;
use App\Models\Blog;
use Illuminate\Support\Arr;

class BlogRepository extends Repository
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $data = Arr::except($request, ['image', 'project_image']);
        $data['image'] = UploadImages::upload($request['image'], 'Blog');
        $data['project_image'] = UploadImages::upload($request['project_image'], 'Blog');
        return $this->create($data);
    }

    public function edit($id, $request)
    {
        $blog=$this->getById($id);
        $data = Arr::except($request, ['image', 'project_image']);
        if (isset($request['image'])) {
            $data['image'] = UploadImages::upload($request['image'], 'Blog',$blog->image);
        }
        if (isset($request['project_image'])) {
            $data['project_image'] = UploadImages::upload($request['project_image'], 'Blog',$blog->project_image);
        }
        return $this->update($id,$data);
    }
}
