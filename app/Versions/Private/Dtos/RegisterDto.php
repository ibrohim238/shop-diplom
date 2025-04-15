<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\RegisterRequest;

final readonly class RegisterDto
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $password,
    ) {
    }

    public static function fromRequest(RegisterRequest $request): RegisterDto
    {
        $validated = $request->validated();

        return new self(
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            email: $validated['email'],
            password: $validated['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'email'      => $this->email,
            'password'   => $this->password,
        ];
    }
}
