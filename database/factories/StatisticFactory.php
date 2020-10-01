<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $browsers = collect(['Chrome', 'Opera', 'Safari', 'Firefox', 'Yandex',
            'Internet Explorer', 'SlimBrowser', 'Maxthon']);
        $engines = collect(['Mozilla/5.0 (compatible; bingbot/2.0 +http://www.bing.com/bingbot.htm)',
            'Googlebot/2.1 (+http://www.googlebot.com/bot.html)',
            'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)']);
        $osystems = collect(['Windows 10', 'Windows 7', 'Linux', 'Tizen', 'Android', 'IOS']);
        $devices = collect(['Samsung Galaxy S6 Edge Plus', 'Apple iPhone XS Max',
            'Microsoft Lumia 650', 'Google Pixel C',
            'Windows 10-based PC using Edge browser', 'Sony Xperia XZ']);

        $browser = $browsers->random();
        $engine = $engines->random();
        $os = $osystems->random();
        $device = $devices->random();

        return [
            'link_id' => Link::factory(),
            'ip' => $this->faker->ipv4,
            'browser' => $browser,
            'engine' => $engine,
            'os' => $os,
            'device' => $device,
        ];
    }
}
