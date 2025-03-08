<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{

    protected $model = UserAddress::class;

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'zipcode' => $this->faker->postcode(),
            'address1' => $this->faker->prefecture(),
            'address2' => $this->faker->city(),
            'address3' => $this->faker->streetName(),
            'address4' => $this->faker->secondaryAddress(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
