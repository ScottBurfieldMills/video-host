<?php

namespace App\GraphQL\Mutations;

use App\PresignedUrlGenerator;
use App\User;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as Type;
use Rebing\GraphQL\Support\Mutation;

class InitiateVideoUpload extends Mutation
{
    /**
     * @var PresignedUrlGenerator $presignedUrlGenerator
     */
    private $presignedUrlGenerator;

    public function __construct(PresignedUrlGenerator $presignedUrlGenerator)
    {
        $this->presignedUrlGenerator = $presignedUrlGenerator;
    }

    public function type(): Type
    {
        return GraphQL::type('InitiateVideoUpload');
    }

    public function args(): array
    {
        return [
            'filename' => ['name' => 'filename', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $url = $this->presignedUrlGenerator->get();

        return ['url' => $url];
    }
}
