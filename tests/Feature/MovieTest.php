<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function a_auth_user_can_add_movies()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(\App\User::class)->create());
        $data = [
            'title' => $this->faker->sentence(),
            'year' => $this->faker->year(),
            'imdb_number' => $this->faker->randomNumber(7),
            'user_id' => 1,
            'poster' => 'poster.jpg',
        ];
        $this->post('/movies', $data)->assertRedirect('/movies');
        $this->assertDatabaseHas('movies', $data);
    }
        /** @test */
        public function a_movie_requires_a_title()
        {
            $this->actingAs(factory(\App\User::class)->create());
            $data = [
                'title' => '',
                'year' => $this->faker->year(),
                'imdb_number' => $this->faker->randomNumber(7),
                'user_id' => 1,
                'poster' => 'poster.jpg',
            ];
            $this->post('/movies', $data)->assertSessionHasErrors('title');
        }
        /** @test */
        public function a_movie_requires_a_year()
        {
            $this->actingAs(factory(\App\User::class)->create());
            $data = [
                'title' => $this->faker->sentence(),
                'year' => '',
                'imdb_number' => $this->faker->randomNumber(7),
                'user_id' => 1,
                'poster' => 'poster.jpg',
            ];
            $this->post('/movies', $data)->assertSessionHasErrors('year');
        }
        /** @test */
        public function a_movie_requires_a_imdb_number()
        {
            $this->actingAs(factory(\App\User::class)->create());
            $data = [
                'title' => $this->faker->sentence(),
                'year' => $this->faker->year(),
                'imdb_number' => '',
                'user_id' => 1,
                'poster' => 'poster.jpg',
            ];
            $this->post('/movies', $data)->assertSessionHasErrors('imdb_number');
        }
        public function a_movie_requires_a_user_id()
        {
            $this->actingAs(factory(\App\User::class)->create());
            $data = [
                'title' => $this->faker->sentence(),
                'year' => $this->faker->year(),
                'imdb_number' => $this->faker->randomNumber(7),
                'user_id' => '',
                'poster' => 'poster.jpg',
            ];
            $this->post('/movies', $data)->assertSessionHasErrors('user_id');
        }
    
}
