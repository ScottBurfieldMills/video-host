<?php

namespace App\GraphQL;

use App\User;
use Overblog\DataLoader\DataLoader;
use Overblog\PromiseAdapter\PromiseAdapterInterface;

class UserDataLoader extends DataLoader
{
    public function __construct(PromiseAdapterInterface $promiseAdapter)
    {
        parent::__construct(static function ($keys) use ($promiseAdapter) {
            $result = [];

            foreach ($keys as $key => $value) {
                $result[$key] = [];
            }

            $items = User::where(['id' => $keys])->get();

            foreach ($items as $item) {
                $result[array_search($item->ID, $keys)][] = $item;
            }

            return $promiseAdapter->createAll($result);
        }, $promiseAdapter);
    }
}
