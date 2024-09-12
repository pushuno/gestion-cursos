<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Feriado;

class FeriadosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_ok_test()
    {
        $this->get(route('feriados.index'))->assertStatus(200)
            ->assertSee('Feriados');
    }

    /** @test */
    public function it_create_feriado_test()
    {
        $this->from(route('feriados.index'))
            ->post(route('feriados.add'),[
                'fecha' => '2020-03-20'
            ])->assertStatus(302);

            $this->assertEquals(1,Feriado::where([
                'fecha' => '2020-03-20'
            ])->count());
    }

    /** @test */
    public function it_create_feriado_validation_fecha_required_test()
    {
        $this->from(route('feriados.index'))
            ->post(route('feriados.add'),[
                'fecha' => ''
            ])->assertRedirect(route('feriados.index'))
            ->assertSessionHasErrors(['fecha' => 'La fecha del feriado es obligatoria']);

            $this->assertEquals(0,Feriado::count());
    }

    /** @test */
    public function it_create_feriado_validation_fecha_unique_test()
    {
        factory(Feriado::class)->create([
            'fecha' => '2020-03-20'
        ]);
        $this->from(route('feriados.index'))
            ->post(route('feriados.add'),[
                'fecha' => '2020-03-20'
            ])->assertRedirect(route('feriados.index'))
            ->assertSessionHasErrors(['fecha' => 'La fecha ingresada ya fué cargada']);

            $this->assertEquals(1,Feriado::count());
    }

    public function it_delete_feriado_test()
    {
        $feriado = factory(Feriado::class)->create([
            'fecha' => '2020-03-20'
        ]);
        $this->from(route('feriados.index'))
            ->delete(route('feriados.delete'),[
                'feriado' => $feriado
            ])->assertStatus(200);

            $this->assertEquals(0,Feriado::count());
    }
}
