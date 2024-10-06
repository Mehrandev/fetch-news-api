<?php

namespace App\Console\Commands;

use App\Jobs\FetchArticlesJob;
use Illuminate\Console\Command;

class FetchArticlesCommand extends Command
{
    protected $signature = 'fetch:articles {--source=*}';
    protected $description = 'Fetch articles from specified third-party sources.';

    public function handle(): int
    {

        // Dispatch the job with the selected sources.
        FetchArticlesJob::dispatch();

        $this->info('FetchArticlesJob dispatched successfully to process all sources from the database.');
        return Command::SUCCESS;
    }
}
