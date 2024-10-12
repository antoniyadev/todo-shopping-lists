<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;

test('create page can be rendered', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $response = $this->get('/shopping-lists/create');
    $response
        ->assertOk()
        ->assertSeeVolt('shopping-lists.create');
});

test('new shopping lists can be created', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $component = Volt::test('shopping-lists.create')
        ->set('title', 'Test Shopping List')
        ->set('recipient', 'test@example.com')
        ->set('sendDate', now()->addMinutes(60));

    $component->call('submit');

    $component->assertRedirect('/shopping-lists');
});
