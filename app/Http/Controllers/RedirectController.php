<?php

namespace App\Http\Controllers;

use App\Models\Link;
use HillelDerish\UAadapter\DonatjAdapter;
use HillelDerish\UAadapter\HisorangeAdapter;
use HillelDerish\UAadapter\UserAgentParserInterface;

final class RedirectController
{
    public function redirect(UserAgentParserInterface $userAgentParser, $id = null)
    {
        // TODO SaveStatisticsJob
        $link = Link::find($id);

        if ($link !== null) {
            $userAgentParser->parse();

            $statistic = new \App\Models\Statistic();
            $statistic->link_id = $id;
            $statistic->ip = request()->ip();
            $statistic->browser = $userAgentParser->getBrowser() ?? null;
            $statistic->engine = $userAgentParser->getEngine() ?? null;
            $statistic->os = $userAgentParser->getOs() ?? null;
            $statistic->device = $userAgentParser->getDevice() ?? null;
            $statistic->save();

            return redirect($link->long_link);
        } else return redirect()->route('links.index')
            ->with('link not found', 'Requested URL is not found!');
    }
}

