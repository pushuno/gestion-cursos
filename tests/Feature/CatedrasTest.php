<?php

namespace Tests\Feature;

use App\Capacitador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Catedra;
use App\Curso;
use App\Sector;
use App\Metodologia;
use App\NivelEstudio;

class CatedrasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_ok_vigentes_test()
    {
        $this->get(route('catedras.vigentes'))->assertStatus(200)
            ->assertSee('Cátedras');
    }

     /** @test */
     public function it_load_ok_vencidas_test()
     {
         $this->get(route('catedras.vencidas'))->assertStatus(200)
             ->assertSee('Cátedras');
     }

    /** @test */
    public function it_create_catedra_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();
        factory(NivelEstudio::class)->create();
        factory(Sector::class)->create();
        $capacitador = factory(Capacitador::class)->create();

        $this->from(route('catedras.new'))
            ->post(route('catedras.add'),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/05/2020',
                'fecha_fin' => '20/06/2020',
                'cupo' => '4',
                'clases_minimas' => '2',
                'capacitadores' => [$capacitador]
            ])->assertRedirect(route('catedras.vigentes'))
            ->assertStatus(302);

            $this->assertEquals(1,Catedra::where([
                'curso_id' => $curso->id,
                'fecha_inicio' => '2020-05-20',
                'fecha_fin' => '2020-06-20',
                'cupo' => '4',
                'clases_minimas' => '2'
            ])->count());
    }


    /** @test */
    public function it_create_catedra_validation_cupo_required_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $this->from(route('catedras.new'))
            ->post(route('catedras.add'),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '',
                'clases_minimas' => '2'
            ])->assertRedirect(route('catedras.new'))
            ->assertSessionHasErrors(['cupo' => 'El cupo de alumnos admitido para curso es obligatoria']);

            $this->assertEquals(0,Catedra::count());
    }

     /** @test */
     public function it_create_catedra_validation_cupo_integer_test()
     {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $this->from(route('catedras.new'))
            ->post(route('catedras.add'),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => 'rr',
                'clases_minimas' => '2'
            ])->assertRedirect(route('catedras.new'))
            ->assertSessionHasErrors(['cupo' => 'El cupo de alumnos admitido debe ser numerico']);

            $this->assertEquals(0,Catedra::count());
     }

    /** @test */
    public function it_create_catedra_validation_clases_minimas_required_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $this->from(route('catedras.new'))
            ->post(route('catedras.add'),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '4',
                'clases_minimas' => ''
            ])->assertRedirect(route('catedras.new'))
            ->assertSessionHasErrors(['clases_minimas' => 'La cantidad mínima de clases es obligatoria']);

            $this->assertEquals(0,Catedra::count());
    }

    /** @test */
    public function it_create_catedra_validation_duracion_leyenda_required_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $this->from(route('catedras.new'))
            ->post(route('catedras.add'),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '4',
                'clases_minimas' => 'r'
            ])->assertRedirect(route('catedras.new'))
            ->assertSessionHasErrors(['clases_minimas' => 'La cantidad mínima de clases debe ser numerica']);

            $this->assertEquals(0,Catedra::count());
    }

    /** @test */
    public function it_update_catedra_test()
    {
        factory(Metodologia::class)->create();
        factory(NivelEstudio::class)->create();
        factory(Sector::class)->create();
        $curso = factory(Curso::class)->create();
        $capacitador = factory(Capacitador::class)->create();

        $catedra = factory(Catedra::class)->create([
            'curso_id' => $curso->id,
            'cupo' => '4',
            'clases_minimas' => '2'
        ]);

        $this->from(route('catedras.edit',['catedra' => $catedra]))
        ->put(route('catedras.update',['catedra' => $catedra]),[
            'curso_id' => $curso->id,
            'fecha_inicio' => '11/11/2020',
            'fecha_fin' => '12/12/2020',
            'cupo' => '3',
            'clases_minimas' => '3',
            'capacitadores' => [$capacitador]
        ])->assertRedirect(route('catedras.vigentes'))
        ->assertStatus(302);

        $this->assertEquals(1,Catedra::where(['curso_id' => $curso->id,
        'fecha_inicio' => '2020-11-11',
        'fecha_fin' => '2020-12-12',
        'cupo' => '3',
        'clases_minimas' => '3'])->where('id',$catedra->id)->count());

    }


    /** @test */
    public function it_update_catedra_validation_cupo_required_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $catedra = factory(Catedra::class)->create();

        $this->from(route('catedras.edit',['catedra' => $catedra]))
            ->put(route('catedras.update',['catedra' => $catedra]),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '',
                'clases_minimas' => '2'
            ])->assertRedirect(route('catedras.edit',['catedra' => $catedra]))
            ->assertSessionHasErrors(['cupo' => 'El cupo de alumnos admitido para curso es obligatoria']);

            $this->assertEquals(0,Catedra::where([
                'curso_id' => $curso->id,
                'fecha_inicio' => '2020-03-20',
                'fecha_fin' => '2020-04-20',
                'cupo' => '',
                'clases_minimas' => '2'])->count());
    }

    /** @test */
    public function it_update_catedra_validation_cupo_integer_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $catedra = factory(Catedra::class)->create();

        $this->from(route('catedras.edit',['catedra' => $catedra]))
            ->put(route('catedras.update',['catedra' => $catedra]),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => 'rr',
                'clases_minimas' => '2'
            ])->assertRedirect(route('catedras.edit',['catedra' => $catedra]))
            ->assertSessionHasErrors(['cupo' => 'El cupo de alumnos admitido debe ser numerico']);

            $this->assertEquals(0,Catedra::where([
                'curso_id' => $curso->id,
                'fecha_inicio' => '2020-03-20',
                'fecha_fin' => '2020-04-20',
                'cupo' => 'rr',
                'clases_minimas' => '2'])->count());
    }

    /** @test */
    public function it_update_catedra_validation_clases_minimas_required_test()
    {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $catedra = factory(Catedra::class)->create();

        $this->from(route('catedras.edit',['catedra' => $catedra]))
            ->put(route('catedras.update',['catedra' => $catedra]),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '4',
                'clases_minimas' => ''
            ])->assertRedirect(route('catedras.edit',['catedra' => $catedra]))
            ->assertSessionHasErrors(['clases_minimas' => 'La cantidad mínima de clases es obligatoria']);

            $this->assertEquals(0,Catedra::where([
                'curso_id' => $curso->id,
                'fecha_inicio' => '2020-03-20',
                'fecha_fin' => '2020-04-20',
                'cupo' => '4',
                'clases_minimas' => ''])->count());
    }

     /** @test */
     public function it_update_catedra_validation_clases_minimas_integer_test()
     {
        factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $catedra = factory(Catedra::class)->create();

        $this->from(route('catedras.edit',['catedra' => $catedra]))
            ->put(route('catedras.update',['catedra' => $catedra]),[
                'curso_id' => $curso->id,
                'fecha_inicio' => '20/03/2020',
                'fecha_fin' => '20/04/2020',
                'cupo' => '4',
                'clases_minimas' => 'rr'
            ])->assertRedirect(route('catedras.edit',['catedra' => $catedra]))
            ->assertSessionHasErrors(['clases_minimas' => 'La cantidad mínima de clases debe ser numerica']);

            $this->assertEquals(0,Catedra::where([
                'curso_id' => $curso->id,
                'fecha_inicio' => '2020-03-20',
                'fecha_fin' => '2020-04-20',
                'cupo' => '4',
                'clases_minimas' => 'rr'])->count());
     }

    /** @test */
    public function it_delete_catedra_test()
    {
        factory(Metodologia::class)->create();
        factory(Curso::class)->create();

        $catedra = factory(Catedra::class)->create();
        $this->from(route('catedras.vigentes'))
        ->delete(route('catedras.delete',['catedra' => $catedra->id]))->assertRedirect(route('catedras.vigentes'))
        ->assertStatus(302);

        $this->assertDatabaseMissing('catedras',['id'=>$catedra->id]);
    }
}
