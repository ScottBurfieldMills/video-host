<?php

namespace App\GraphQL\Types;

use App\User;
use App\Video;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Name',
        'description' => '',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the User'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the User'
            ]
        ];
    }
}
