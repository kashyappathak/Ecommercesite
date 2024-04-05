<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_store()
    {
        $response = $this->call('POST', 'admin/users',[
            'name' => 'pathak Kashyap',
            'email'=> 'pathakkashyap80@gmail.com',
            'password'=> 'Kashyap@29',

        ]);
        $response->assertStatus($response->status() , 200);
        
    }
}
