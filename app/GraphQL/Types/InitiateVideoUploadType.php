<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class InitiateVideoUploadType extends GraphQLType
{
    protected $attributes = [
        'name' => 'InitiateVideoUploadType',
        'description' => '',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of the InitiateVideoUpload'
            ],
            'url' => [
                'type' => Type::string(),
                'description' => 'Upload URL'
            ]
        ];
    }
}
