<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Inertia\Testing\Assert;

class PageControllerTest extends TestCase
{

    /** @test */
    public function home()
    {
        $response = $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('skills')
                ->has('skills.backend')
                ->has('skills.frontend')
                ->has('skills.testing')
                ->has('skills.misc')
                ->missing('projects')
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function projects()
    {
        $response = $this->get('/projects')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Projects')
                ->has('projects')
                ->missing('skills')
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function contact()
    {
        $response = $this->get('/contact')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Contact')
                ->missing('projects')
                ->missing('skills')
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function contactFormSubmitted()
    {
        Mail::fake();

        $data = [
            'name' => 'Tulip Tester',
            'email' => 'tulip@test.org',
            'start' => 'ASAP',
            'type' => 'Backend',
            'remote' => 'Remote',
            'description' => 'Sweet job that you will definitely like!',
            'captcha_token' => 'some_fake_key_for_testing',
        ];

        $response = $this->post('/contact', $data);

        Mail::assertSent(ContactFormSubmitted::class);

        $response->assertStatus(200);
    }

    /** @test */
    public function contactFormNotSubmittedMissingRequiredFields()
    {
        Mail::fake();

        $data = [
            'name' => '',
            'email' => 'tulip@test.org',
            'start' => 'ASAP',
            'type' => 'Backend',
            'remote' => 'Remote',
            'description' => '',
        ];

        $response = $this->post('/contact', $data);

        Mail::assertNotSent(ContactFormSubmitted::class);
        Mail::assertNothingSent();

        $response->assertStatus(302);
        $response->assertSessionHasErrors('description');
        $response->assertSessionHasErrors('name');
    }
}
