<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    function test_registration_page_contains_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    function test_can_register()
    {
        Livewire::test('auth.register')
                ->set('name', 'John Doe')
                ->set('email', 'johdoe@gmail.com')
                ->set('password', 'secret')
                ->set('confirmPassword', 'secret')
                ->call('register')
                ->assertRedirect('/');
        $this->assertTrue(User::whereEmail('johdoe@gmail.com')->exists());

        $this->assertEquals('johdoe@gmail.com', auth()->user()->email);

    }

    function test_email_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'John Doe')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('confirmPassword', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);

    }

    function test_email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('name', 'John Doe')
            ->set('email', 'caca')
            ->set('password', 'secret')
            ->set('confirmPassword', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);

    }

    function test_email_has_already_been_taken()
    {
        User::create(['name'=>'Test', 'email'=>'johndoe@yopmail.com', 'password' => 'secret']);
        Livewire::test('auth.register')
            ->set('name', 'John Doe')
            ->set('email', 'johndoe@yopmail.com')
            ->set('password', 'secret')
            ->set('confirmPassword', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);

    }
}
