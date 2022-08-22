<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->date,
            'sexo' => \Arr::random(['Masculino', 'Femenino', 'Otro']),
            'curp' => $this->faker->unique->text(18),
            'correo_electronico' => $this->faker->unique->email,
            'address' => $this->faker->address,
        ];
    }
}
