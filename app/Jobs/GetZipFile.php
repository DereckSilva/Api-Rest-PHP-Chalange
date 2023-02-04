<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class GetZipFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path;
    private $client;
    private $endpoint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $endpoint, string $path)
    {
        $this->endpoint = $endpoint;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client = new Client();

        $file = file($this->path);

        foreach ( $file as $line ) {

            $line = trim($line);

            $response = $this->client->get($this->endpoint.$line);

            $content = $response->getBody()->getContents();

            if (!Cache::has($line)) {

                Cache::put($line, $line, 604800);
                Storage::put($line, $content);

                $path = storage_path('app/openFood/');

                ExtractData::dispatch($path, $line);
                break;
            }

        }
    }
}
