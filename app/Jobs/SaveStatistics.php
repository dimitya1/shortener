<?php
//
//namespace App\Jobs;
//
//use App\Models\Link;
//use App\Models\Statistic;
//use HillelDerish\UAadapter\HisorangeAdapter;
//use HillelDerish\UAadapter\UserAgentParserInterface;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
//
//class SaveStatistics implements ShouldQueue
//{
//    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//
//    private $linkId;
//    private $ip;
//    /**
//     * @var string
//     */
//    private $userAgent;
//
//    /**
//     * SaveStatistics constructor.
//     * @param string $linkId
//     * @param string $ip
//     * @param string $userAgent
//     */
//    public function __construct(string $linkId, string $ip, string $userAgent)
//    {
//        $this->linkId = $linkId;
//        $this->ip = $ip;
//        $this->userAgent = $userAgent;
//    }
//
//    /**
//     * Execute the job.
//     *
//     * @param UserAgentParserInterface $userAgentParser
//     * @return void
//     */
//    public function handle(UserAgentParserInterface $userAgentParser)
//    {
//        $userAgentParser->parse($this->userAgent);
//
//
//        $statistic = new Statistic();
//        $statistic->link_id = $this->linkId;
//        $statistic->ip = $this->ip;
//        $statistic->browser = $userAgentParser->getBrowser() ?? null;
//        $statistic->engine = $userAgentParser->getEngine() ?? null;
//        $statistic->os = $userAgentParser->getOs() ?? null;
//        $statistic->device = $userAgentParser->getDevice() ?? null;
//        $statistic->save();
//    }
//}
