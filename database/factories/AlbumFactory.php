<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(100),
            'album_cover' => $this->faker->imageUrl(640, 480, 'music', true),
            'release_date' => $this->faker->dateTimeBetween(
                '- 10 years',
                '- 1 year'),
            'created_at' => $this->faker->dateTimeBetween(
            '- 8 weeks',
            '- 4 week'),
            'updated_at' => $this->faker->dateTimeBetween(
            '- 4 weeks',
            '- 1 week'),
            'deleted_at' => rand(0, 10) === 0 ? $this->faker->dateTimeBetween(
                '- 1 week',
                '+ 2 weeks') : null
        ];
    }
}
