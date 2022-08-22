<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_applicants()
    {
        $applicants = Applicant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('applicants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.index')
            ->assertViewHas('applicants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_applicant()
    {
        $response = $this->get(route('applicants.create'));

        $response->assertOk()->assertViewIs('app.applicants.create');
    }

    /**
     * @test
     */
    public function it_stores_the_applicant()
    {
        $data = Applicant::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('applicants.store'), $data);

        $this->assertDatabaseHas('applicants', $data);

        $applicant = Applicant::latest('id')->first();

        $response->assertRedirect(route('applicants.edit', $applicant));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->get(route('applicants.show', $applicant));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.show')
            ->assertViewHas('applicant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->get(route('applicants.edit', $applicant));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.edit')
            ->assertViewHas('applicant');
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

        $response = $this->put(route('applicants.update', $applicant), $data);

        $data['id'] = $applicant->id;

        $this->assertDatabaseHas('applicants', $data);

        $response->assertRedirect(route('applicants.edit', $applicant));
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->delete(route('applicants.destroy', $applicant));

        $response->assertRedirect(route('applicants.index'));

        $this->assertSoftDeleted($applicant);
    }
}
