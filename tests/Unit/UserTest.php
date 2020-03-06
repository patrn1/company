<?php

namespace Tests\Unit;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the user creation.
     *
     * @return void
     */
    public function testCreation()
    {
        $this->be(new User());

        $newUser = [
            'name' => 'Test User',
            'email' => 'tes@example.com',
        ];

        $this
            ->followingRedirects()
            ->post('/users', array_merge($newUser, [ 'password' => '1234' ]))
            ->assertStatus(200);
        $this->assertDatabaseHas('users', $newUser);
    }

    /**
     * Test the user update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->be(new User());

        $newUser = [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        $this
            ->followingRedirects()
            ->post('/users', array_merge($newUser, [ 'password' => '1234' ]));

        $updatedUser = [
            'name' => 'Updated Test User',
            'email' => 'updated_test@example.com',
        ];

        $createdUser = User::where('email', $newUser[ 'email' ])->get();
        $this->assertArrayHasKey(0, $createdUser);
        $createdUserId = $createdUser[0]->id;
        $this
            ->followingRedirects()
            ->post("/users/$createdUserId/edit", array_merge($updatedUser, [ 'password' => '1234' ]))
            ->assertStatus(200);

        $this->assertDatabaseHas('users', array_merge($updatedUser, [ 'id' => $createdUserId ]));
    }

    /**
     * Test the user list.
     *
     * @return void
     */
    public function testUsersList()
    {
        $this->be(new User());

        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertViewHas('userList');
    }
}
