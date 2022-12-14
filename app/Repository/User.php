<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Builder;


class User extends \App\Models\User implements Repository {


    public static function formRules(): array
    {
        return [
            "data.name"     => 'required',
            'data.email'    => 'required',
            'data.password' => 'required',
        ];
    }

    public static function formMessages(): array
    {
        return [];
    }


    public static function formField($params = null): array
    {
        return [
            [
                'title'       => 'Textarea',
                'type'        => 'editor',
                'model'       => 'name',
                'options'     => [
                    ['value' => 1, 'title' => 'asdasd'],
                    ['value' => 2, 'title' => 'asdaaaasd'],
                    ['value' => 3, 'title' => 'asdaaaasd'],
                    ['value' => 4, 'title' => 'asdaaaasd'],
                    ['value' => 5, 'title' => 'asdaaaasd'],
                    ['value' => 6, 'title' => 'asdaaaasd'],
                ],
                'required'    => false,
                'placeholder' => 'Nama',
            ],
            [
                'title'    => 'Password',
                'type'     => 'file',
                'model'    => 'passwordaa',
                'required' => false,
                'step'     => '0.2',

            ],
            [
                'title'       => 'Email',
                'type'        => 'email',
                'model'       => 'email',
                'required'    => false,
                'placeholder' => '',
            ],
        ];
    }

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%');
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => '#', 'sort' => 'id','width'=>'7%'],
            ['label' => 'Name', 'sort' => 'name'],
            ['label' => 'Email', 'sort' => 'email'],
            ['label' => 'Role', 'sort' => 'role'],
            ['label' => 'Action'],
        ];
    }

    public static function tableData($data = null): array
    {
        $edit = route('admin.dashboard');
        return [
            ['type' => 'index'],
            ['type' => 'string', 'data' => $data->name],
            ['type' => 'string', 'data' => $data->email],
            ['type' => 'thousand_format', 'data' => $data->role],
            ['type' => 'action', 'data' => [
                    ['title'=>'Edit','icon'=>'fa fa-eye', 'link'=>$edit],
                    ['title'=>'Hapus','icon'=>'fa fa-trash', 'live'=>'delete'],

            ],
            ],
        ];
    }
}
