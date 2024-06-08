<?php

namespace Tests\Feature;

use Tests\TestCase;

class VentaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        /* $headers = [
            'X-CSRF-TOKEN' => 'k21Kl7a3wmL8dQJryeuZObZ0FZ0tozT1krsGceqF',
        ];
        $response = $this->get('/producto', [], $headers)
            ->assertStatus(200); */

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['usuario_id' => '1'])
            ->get('/producto');

    }
}
