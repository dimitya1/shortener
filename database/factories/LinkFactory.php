<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => self::factoryForModel(User::class),
            'old_link' => $this->faker->url,
            'new_link' => Str::of($this->faker->url)->limit(15, ''),
            'count' => rand(0, 150),
        ];
    }
}
