<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Applicant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_applicants_list()
    {
        $applicants = Applicant::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.applicants.index'));

        $response->assertOk()->assertSee($applicants[0]->nombre);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant()
    {
        $data = Applicant::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.applicants.store'), $data);

        $this->assertDatabaseHas('applicants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_applicant()
    {
        $applicant = Applicant::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->date,
            'sexo' => \Arr::random(['Masculino', 'Femenino', 'Otro']),
            'curp' => $this->faker->unique->text(18),
            'correo_electronico' => $this->faker->unique->email,
            'address' => $this->faker->address,
        ];

        $response = $this->putJson(
            route('api.applicants.update', $applicant),
            $data
        );

        $data['id'] = $applicant->id;

        $this->assertDatabaseHas('applicants', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->deleteJson(
            route('api.applicants.destroy', $applicant)
        );

        $this->assertSoftDeleted($applicant);

        $response->assertNoContent();
    }
}
