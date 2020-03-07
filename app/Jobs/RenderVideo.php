<?php

namespace App\Jobs;

use App\User;
use App\Video;
use Exception;
use Faker\Factory;
use Faker\Guesser\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class RenderVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Video $video */
    public $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function handle(): void
    {
        $new = new Video();
        $faker = Factory::create();
        $new->title = $faker->words(3, true);
        $new->slug = substr(Str::slug($new->title), 0, 16);
        $new->user_id = User::all()->first()->id;
        $new->save();
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags(): array
    {
        return ['render', 'video:'.$this->video->id];
    }
}
