<?php

namespace App\GraphQL\Queries;

use App\Video;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class VideosQuery extends Query
{
    protected $attributes = [
        'name' => 'videos'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Video'));
    }

    public function resolve($root, $args)
    {
        return Video::all();
    }
}
