<?php

namespace App\Jobs;

use App\Traits\ReturnNameFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExtractData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ReturnNameFile;

    private $file;
    private $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $file)
    {
        $this->path = $path;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file_gz = file_get_contents($this->path.$this->file);
        $content_gz = gzdecode($file_gz);

        $file = $this->nameFile($this->file, '.');

        Storage::put($file.'.txt', $content_gz);

        $src = fopen($this->path.$file.'.txt', 'r');

        Storage::append($file.'Extract.txt', '');
        $dest = fopen($this->path.$file.'Extract.txt', 'w');

        stream_copy_to_stream($src, $dest, 580294);

    }
}
