<?php

namespace Tests\Feature;

use App\Capacitador;
use App\Catedra;
use App\Cursante;
use App\Metodologia;
use App\Curso;
use App\Inscripcion;
use App\NivelEstudio;
use App\Sector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CursosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_ok_test()
    {
        $this->get(route('cursos.index'))->assertStatus(200)
            ->assertSee('Cursos');
    }

    /** @test */
    public function it_add_ok_test()
    {
        $this->get(route('cursos.add'))->assertStatus(200)
            ->assertSee('Cursos');
    }

     /** @test */
     public function it_edit_ok_test()
     {
        $metodologia = factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create();

        $this->get(route('cursos.edit',['curso' => $curso]))->assertStatus(200)
             ->assertSee('Cursos');
     }

    /** @test */
    public function it_create_curso_test()
    {
        $this->withExceptionHandling();
        $metodologia = factory(Metodologia::class)->create();

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => 'Computación aplicada',
                'descripcion' => 'curso de computacion aplicada',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
            ])->assertRedirect(route('cursos.index'))
            ->assertStatus(302);

            $this->assertEquals(1,Curso::where([
                'nombre' => 'Computación aplicada',
                'descripcion' => 'curso de computacion aplicada',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
            ])->count());
    }

    /** @test */
    public function it_create_curso_validation_nombre_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => '',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
            ])->assertRedirect(route('cursos.new'))
            ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

            $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_create_curso_validation_metodologia_required_test()
    {

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => 'Computación aplicada',
                'metodologia_id' => '',
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
            ])->assertRedirect(route('cursos.new'))
            ->assertSessionHasErrors(['metodologia_id' => 'La metodología es obligatoria']);

            $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_create_curso_validation_duracion_horas_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => 'Computación aplicada',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => ''
            ])->assertRedirect(route('cursos.new'))
            ->assertSessionHasErrors(['duracion_horas' => 'La cantidad de horas del curso es obligatoria']);

            $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_create_curso_validation_duracion_horas_integer_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => 'Computación aplicada',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => 't'
            ])->assertRedirect(route('cursos.new'))
            ->assertSessionHasErrors(['duracion_horas' => 'La duración debe ser un numero entero de horas']);

            $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_create_curso_validation_duracion_leyenda_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $this->from(route('cursos.new'))
            ->post(route('cursos.add'),[
                'nombre' => 'Computación aplicada',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '',
                'duracion_horas' => '5'
            ])->assertRedirect(route('cursos.new'))
            ->assertSessionHasErrors(['duracion_leyenda' => 'La descripción de la duracion es obligatoria']);

            $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_update_curso_test()
       {
        $metodologia = factory(Metodologia::class)->create();
        $curso = factory(Curso::class)->create([
            'nombre' => 'Computación aplicada',
            'metodologia_id' => $metodologia->id,
            'duracion_leyenda' => '6 clases de 2hs',
            'duracion_horas' => '5'
        ]);

        $this->from(route('cursos.edit',['curso' => $curso]))
        ->put(route('cursos.update',['curso' => $curso]),[
            'nombre' => 'Cocina 2',
            'metodologia_id' => $metodologia->id,
            'duracion_leyenda' => '2 clases de 2hs',
            'duracion_horas' => '2'
        ])->assertRedirect(route('cursos.index'))
        ->assertStatus(302);

        $this->assertEquals(1,Curso::where(['nombre' => 'Cocina 2',
        'metodologia_id' => $metodologia->id,
        'duracion_leyenda' => '2 clases de 2hs',
        'duracion_horas' => '2'])->where('id',$curso->id)->count());

    }

    /** @test */
    public function it_update_curso_validation_nombre_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create([
            'duracion_horas' => '3'
        ]);

        $this->from(route('cursos.edit',['curso' => $curso]))
             ->put(route('cursos.update',['curso' => $curso]),[
                'nombre' => '',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
             ])->assertRedirect(route('cursos.edit',['curso' => $curso]))
             ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

            $this->assertEquals(0,Curso::where('duracion_horas','5')->count());
    }

    /** @test */
    public function it_update_curso_validation_metodologia_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();

        $this->from(route('cursos.edit',['curso' => $curso]))
             ->put(route('cursos.update',['curso' => $curso]),[
                'nombre' => 'Cocina 2',
                'metodologia_id' => '',
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => '5'
             ])->assertRedirect(route('cursos.edit',['curso' => $curso]))
             ->assertSessionHasErrors(['metodologia_id' => 'La metodología es obligatoria']);

            $this->assertEquals(0,Curso::where([
            'metodologia_id' => '',
            'duracion_leyenda' => '6 clases de 2hs',
            'duracion_horas' => '5'])->count());
    }

    /** @test */
    public function it_update_curso_validation_duracion_leyenda_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();

        $this->from(route('cursos.edit',['curso' => $curso]))
            ->put(route('cursos.update',['curso' => $curso]),[
                'nombre' => 'Cocina 2',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '',
                'duracion_horas' => '5'
            ])->assertRedirect(route('cursos.edit',['curso' => $curso]))
            ->assertSessionHasErrors(['duracion_leyenda' => 'La descripción de la duracion es obligatoria']);

            $this->assertEquals(0,Curso::where([
            'metodologia_id' => $metodologia->id,
            'duracion_leyenda' => '',
            'duracion_horas' => '5'])->count());
    }

    /** @test */
    public function it_update_curso_validation_duracion_horas_required_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();

        $this->from(route('cursos.edit',['curso' => $curso]))
            ->put(route('cursos.update',['curso' => $curso]),[
                'nombre' => 'Cocina 2',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => ''
            ])->assertRedirect(route('cursos.edit',['curso' => $curso]))
            ->assertSessionHasErrors(['duracion_horas' => 'La cantidad de horas del curso es obligatoria']);

            $this->assertEquals(0,Curso::where([
            'metodologia_id' => $metodologia->id,
            'duracion_leyenda' => '6 clases de 2hs',
            'duracion_horas' => ''])->count());
    }

    /** @test */
    public function it_update_curso_validation_duracion_horas_integer_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();

        $this->from(route('cursos.edit',['curso' => $curso]))
            ->put(route('cursos.update',['curso' => $curso]),[
                'nombre' => 'Cocina 2',
                'metodologia_id' => $metodologia->id,
                'duracion_leyenda' => '6 clases de 2hs',
                'duracion_horas' => 'rr'
            ])->assertRedirect(route('cursos.edit',['curso' => $curso]))
            ->assertSessionHasErrors(['duracion_horas' => 'La duración debe ser un numero entero de horas']);

            $this->assertEquals(0,Curso::where([
            'metodologia_id' => $metodologia->id,
            'duracion_leyenda' => '6 clases de 2hs',
            'duracion_horas' => 'rr'])->count());
    }

    /** @test */
    public function it_real_delete_curso_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();
        $this->from(route('cursos.index'))
        ->delete(route('cursos.delete',['curso' => $curso->id]))->assertRedirect(route('cursos.index'))
        ->assertStatus(302);

        $this->assertEquals(0,Curso::count());
    }

    /** @test */
    public function it_delete_curso_test()
    {
        $metodologia = factory(Metodologia::class)->create();

        $curso = factory(Curso::class)->create();
        factory(NivelEstudio::class)->create();
        factory(Sector::class)->create();
        factory(Cursante::class)->create();
        factory(Catedra::class)->create();
        factory(Inscripcion::class)->create();

        $this->from(route('cursos.index'))
        ->delete(route('cursos.delete',['curso' => $curso->id]))->assertRedirect(route('cursos.index'))
        ->assertStatus(302);

        $this->assertEquals(1,Curso::where('eliminado',true)->count());
    }

}
