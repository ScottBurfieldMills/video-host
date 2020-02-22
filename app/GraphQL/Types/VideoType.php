<?php

namespace App\GraphQL\Types;

use App\GraphQL\UserDataLoader;
use App\User;
use App\Video;
use GraphQL\Executor\Promise\Adapter\SyncPromiseAdapter;
use GraphQL\Type\Definition\Type;
use leinonen\DataLoader\CacheMap;
use leinonen\DataLoader\DataLoader;
use Overblog\PromiseAdapter\Adapter\WebonyxGraphQLSyncPromiseAdapter;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\EventLoop\StreamSelectLoop;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class VideoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Video',
        'description' => '',
        'model' => Video::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the Video'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the Video'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The slug of the Video'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the User who uploaded the Video'
            ],
            'user' => [
                'type' => GraphQL::type('User')
            ]
        ];
    }

    public function resolveUserField(Video $video, $args)
    {
//        return $video->user()->first();

        $userDataLoader = app(UserDataLoader::class);
        return $userDataLoader->load($video->user_id);
//
//        return new GraphQL\Deferred(function () use ($video) {


            // -- or --


//            $userByIdLoader = new DataLoader(function ($ids) {
//                $users = User::where(['id' => $ids]);
//
//                // Make sure the users are the same order as given ids for the loader
//                $orderedUsers = collect($ids)->map(function ($id) use ($users) {
//                    return $users->first(function ($user) use ($id) {
//                        return $user->id === $id;
//                    });
//                });
//
//                return \React\Promise\resolve($orderedUsers);
//            }, app(LoopInterface::class), app(CacheMap::class));
//
//            return $userByIdLoader->load($video->user_id);
        // });
//        return $video->user()->first();
//        $userDataLoader = app(UserDataLoader::class);
//
//        return $userDataLoader->load($video->user_id);
    }
}
