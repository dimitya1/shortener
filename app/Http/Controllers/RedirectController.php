<?php

namespace App\Http\Controllers;

use App\Models\Link;
use HillelDerish\UAadapter\HisorangeAdapter;
use Illuminate\Support\Facades\App;

final class RedirectController
{
    public function redirect($id = null)
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

        $link = Link::find($id);
        $link->count++;
        $link->save();
        return redirect($link->old_link);
    }
}

