<?php

namespace App\Http\Requests\Blog;


use App\Http\Requests\APIRequest;

class BlogRequest extends APIRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'title' => ['required', 'min:3', 'max:100', 'string'],
                        'description' => ['required', 'string', 'min:3', 'max:300'],
                        'project_title' => ['required', 'min:3', 'max:100', 'string'],
                        'project_description' => ['required', 'string', 'min:3', 'max:300'],
                        'image' => ['required', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                        'start_date' => ['required', 'date_format:Y-m-d'],
                        'end_date' => ['required', 'date_format:Y-m-d','after:start_date'],
                        'project_image' => ['required', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                    ];
                }
            case 'PUT':
                {
                    return [
                        'title' => ['nullable', 'min:3', 'max:100', 'string'],
                        'description' => ['nullable', 'string', 'min:3', 'max:300'],
                        'project_title' => ['nullable', 'min:3', 'max:100', 'string'],
                        'project_description' => ['nullable', 'string', 'min:3', 'max:300'],
                        'image' => ['nullable', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                        'start_date' => ['nullable', 'date_format:Y-m-d'],
                        'end_date' => ['nullable', 'date_format:Y-m-d','after:end_date'],
                        'project_image' => ['nullable', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'title' => ['nullable', 'min:3', 'max:100', 'string'],
                        'description' => ['nullable', 'string', 'min:3', 'max:300'],
                        'project_title' => ['nullable', 'min:3', 'max:100', 'string'],
                        'project_description' => ['nullable', 'string', 'min:3', 'max:300'],
                        'image' => ['nullable', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                        'start_date' => ['nullable', 'date_format:Y-m-d'],
                        'end_date' => ['nullable', 'date_format:Y-m-d','after:end_date'],
                        'project_image' => ['nullable', 'image', 'max:5125', 'mimes:jpeg,png,jpg,gif,svg'],
                    ];
                }
            default:
                break;
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'user_id' => auth()->id(),
        ]);
    }

    public function attributes()
    {
        return [
            'title' => trans('admin.title'),
            'description' => trans('admin.description'),
            'project_title' => trans('admin.project_title'),
            'project_description' => trans('admin.project_description'),
            'image' => trans('admin.image'),
            'project_image' => trans('admin.project_image'),
            'start_date' => trans('admin.start_date'),
            'end_date' => trans('admin.end_date'),
        ];
    }
}
