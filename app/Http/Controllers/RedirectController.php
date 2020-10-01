<?php

namespace App\Http\Controllers;

use App\Jobs\SaveStatistics;
use App\Models\Link;
use HillelDerish\UAadapter\DonatjAdapter;
use HillelDerish\UAadapter\HisorangeAdapter;

final class RedirectController
{
    public function redirect($id = null)
    {
//        $uaParser = new HisorangeAdapter();
//        $uaParser->parse();
//
//        $statistic = new \App\Models\Statistic();
//        $statistic->link_id = $id;
//        $statistic->ip = request()->ip();
//        $statistic->browser = $uaParser->getBrowser() ?? null;
//        $statistic->engine = $uaParser->getEngine() ?? null;
//        $statistic->os = $uaParser->getOs() ?? null;
//        $statistic->device = $uaParser->getDevice() ?? null;
//        $statistic->save();

        $link = Link::find($id);

        if ($link !== null) {
            dispatch(new SaveStatistics($link->id, request()->ip()))->onQueue('default');

            return redirect($link->long_link);
        } else return redirect()->route('links.index')
            ->with('link not found', 'Requested URL is not found!');
    }
}

