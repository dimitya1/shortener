<?php

namespace App\Jobs;

use App\Models\Statistic;
use App\Models\User;
use HillelDerish\UAadapter\HisorangeAdapter;
use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @param Request $request
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $uaParser = new HisorangeAdapter();
        $uaParser->parse();

        $statistic = new \App\Models\Statistic();
        $statistic->user_id = auth()->id();
        $statistic->ip = request()->ip();
        $statistic->browser = $uaParser->getBrowser() ?? null;
        $statistic->engine = $uaParser->getEngine() ?? null;
        $statistic->os = $uaParser->getOs() ?? null;
        $statistic->device = $uaParser->getDevice() ?? null;
        $statistic->save();
    }
}
