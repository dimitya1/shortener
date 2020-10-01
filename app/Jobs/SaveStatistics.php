<?php

namespace App\Jobs;

use App\Models\Link;
use App\Models\Statistic;
use HillelDerish\UAadapter\HisorangeAdapter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $linkId;
    private $ip;
    /**
     * SaveStatistics constructor.
     * @param string $linkId
     * @param string $ip
     */
    public function __construct(string $linkId, string $ip)
    {
        $this->linkId = $linkId;
        $this->ip = $ip;
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

        $statistic = new Statistic();
        $statistic->link_id = $this->linkId;
        $statistic->ip = $this->ip;
        $statistic->browser = $uaParser->getBrowser() ?? null;
        $statistic->engine = $uaParser->getEngine() ?? null;
        $statistic->os = $uaParser->getOs() ?? null;
        $statistic->device = $uaParser->getDevice() ?? null;
        $statistic->save();
    }
}
