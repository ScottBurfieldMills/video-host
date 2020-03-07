<?php

namespace App\Videos;

use Str;

class SlugGenerator
{
    public function generate(string $str, int $maxLength = 16)
    {
        return substr(Str::slug($str), 0, $maxLength);
    }
}
