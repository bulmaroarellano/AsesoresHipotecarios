<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folio' => $this->faker->unique()->bothify('????-###'),
            'status' => $this->faker->boolean,
            'applicant_id' => \App\Models\Applicant::factory(),
            'order_id' => \App\Models\Order::factory(),
        ];
    }
}
