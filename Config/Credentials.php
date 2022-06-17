<?php

namespace App\Credentials;

class Credentials
{
    public function getCredentials(): array
    {
        return [
            'user1@test.com' => [
                'name' => 'John',
                'password' => '$2y$10$1cZEjcezOfIJkwYdXJelrerz6LfvixaVI/R8VWCuf7A2tPALIkc2q', //123456
            ],
            'user2@test.com' => [
                'name' => 'Jane',
                'password' => '$2y$10$jUVUZBOFaJ6UkZEX6Md47uShUSWcIKQqq/oEZDQSWmrncDE37j.0y', //654321
            ],
        ];
    }
}