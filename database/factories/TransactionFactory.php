<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            "user_id"=> fake()->numberBetween(1, 20),
            "transaction_id"=> 'D'.rand(1,20).'_'.time(),
            "amount" => fake()->numberBetween(1, 1000)
        ];
    }
}
