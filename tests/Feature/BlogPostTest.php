<?php

namespace Tests\Feature;

use App\Http\Requests\BlogPostRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');
    //     $response->assertStatus(200);
    // }

    public function check_blog_post_create_validations_are_working()
    {
        $request = new BlogPostRequest();

        $validator = $this->app['validator']->make([], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('blog_post_title'));
        $this->assertTrue($validator->errors()->has('blog_post_content'));
        $this->assertTrue($validator->errors()->has('blog_post_publish_date'));
    }
}
