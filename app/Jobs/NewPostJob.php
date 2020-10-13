<?php

namespace App\Jobs;

use App\Notifications\NewPostNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post,$user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($post, $user)
    {
        $user->notify(new NewPostNotification($post));
    }
}
