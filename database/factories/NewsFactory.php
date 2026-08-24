<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(mt_rand(6, 10));
        return [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'news_category_id' => \App\Models\NewsCategory::inRandomOrder()->first()?->id ?? 1,
            'user_id' => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'content' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>',
            'status' => $this->faker->randomElement(['published', 'published', 'published', 'draft', 'archived']),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'views_count' => mt_rand(50, 2500),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(20),
            'meta_keywords' => 'unhas, ltdka, berita, ' . $this->faker->word(),
        ];
    }
}
