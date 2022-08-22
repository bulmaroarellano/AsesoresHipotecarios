<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'destino' => \Arr::random([
                'casa',
                'auto',
                'préstamo',
                'tarjeta de crédito',
            ]),
            'monto_solicitado' => $this->faker->numberBetween(10000, 1000000),
            'plazo' => $this->faker->numberBetween(1, 10),
        ];
    }
}
