<?php

namespace App\Http\Controllers\API;

use App\Helper\Traits\ApiPaginator;
use App\Helper\Traits\RESTApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Repository\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use RESTApi,ApiPaginator;
    protected $blogRepo;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function index(Request $request)
    {
        $page_size = $request->limit ?? 10;
        $blogs=$this->blogRepo->with('user')->paginate($page_size);
        return $this->sendJson($this->getPaginatedResponse($blogs,BlogResource::collection($blogs)));
    }

    public function store(BlogRequest $request)
    {
        $blog=$this->blogRepo->store($request->validated());
        return $this->sendJson(trans('admin.created'));
    }

    public function show($id)
    {
        $blog=$this->blogRepo->with('user')->findOrFail($id);
        return $this->sendJson(new BlogResource($blog));
    }

    public function update($id,BlogRequest $request)
    {
        $blog=$this->blogRepo->edit($id,$request->validated());
        return $this->sendJson(trans('admin.updated'));
    }

    public function destroy($id)
    {
        return $this->sendError(trans('admin.not_permission'),403);
    }

}
