<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Capacitador;
use App\NivelEstudio;
use App\Sector;

class CapacitadoresTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_ok_test()
    {
        $this->get(route('capacitadores.index'))->assertStatus(200)
            ->assertSee('Capacitadores');
    }

    /** @test */
    public function it_create_capacitador_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.index'))
            ->assertStatus(302);

            $this->assertEquals(1,Capacitador::where('nombre','Lucas')->count());
    }

    /** @test */
    public function it_create_capacitador_validation_nombre_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => '',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_create_capacitador_validation_apellido_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => '',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['apellido' => 'El apellido es obligatorio']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_create_capacitador_validation_fecha_nacimiento_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['fecha_nacimiento' => 'La fecha de nacimiento es obligatoria']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_create_capacitador_validation_nivel_estudio_required_test()
    {
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => '',
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['nivel_estudio_id' => 'El nivel de estudio alcanzado es obligatorio']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_create_capacitador_validation_sector_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => '',
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['sector_id' => 'Debe especificar el sector al que pertenece el capacitador']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_create_capacitador_validation_telefono_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('capacitadores.new'))
            ->post(route('capacitadores.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => 'rrr',
                'sector_id' => $sector->id,
                'legajo' => '300924',
                'oficina' => 'Suministros',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('capacitadores.new'))
            ->assertSessionHasErrors(['telefono' => 'El numero de telefono unicamente puede contener numeros']);

            $this->assertEquals(0,Capacitador::count());
    }

    /** @test */
    public function it_update_capacitador_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();
        $capacitador = factory(Capacitador::class)->create();
        $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
        ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'sector_id' => $sector->id,
                'legajo' => '300924'
        ])->assertRedirect(route('capacitadores.index'))
        ->assertStatus(302);

        $this->assertEquals(1,Capacitador::where('nombre','Lucas')->where('id',$capacitador->id)->count());

    }


       /** @test */
       public function it_update_capacitador_validation_nombre_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();
           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => '',
                    'apellido' => 'Febbroni',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '45454545',
                    'sector_id' => $sector->id,
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
               ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
               ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

               $this->assertEquals(1,Capacitador::count());
       }

       /** @test */
       public function it_update_capacitador_validation_apellido_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => 'Lucas',
                    'apellido' => '',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '45454545',
                    'sector_id' => $sector->id,
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
               ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
               ->assertSessionHasErrors(['apellido' => 'El apellido es obligatorio']);

               $this->assertEquals(1,Capacitador::count());
       }


       /** @test */
       public function it_update_capacitador_validation_fecha_nacimiento_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => 'Lucas',
                    'apellido' => 'Febbroni',
                    'fecha_nacimiento' => '',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '45454545',
                    'sector_id' => $sector->id,
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
               ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
               ->assertSessionHasErrors(['fecha_nacimiento' => 'La fecha de nacimiento es obligatoria']);

               $this->assertEquals(1,Capacitador::count());
       }

       /** @test */
       public function it_update_capacitador_validation_nivel_estudio_required_test()
       {
           factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => 'Lucas',
                    'apellido' => 'Febbroni',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => '',
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '45454545',
                    'sector_id' => $sector->id,
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
                ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->assertSessionHasErrors(['nivel_estudio_id' => 'El nivel de estudio alcanzado es obligatorio']);

               $this->assertEquals(1,Capacitador::count());
       }

       /** @test */
       public function it_update_capacitador_validation_sector_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           factory(Sector::class)->create();
           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => 'Lucas',
                    'apellido' => 'Febbroni',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '45454545',
                    'sector_id' => '',
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
                ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->assertSessionHasErrors(['sector_id' => 'Debe especificar el sector al que pertenece el capacitador']);

               $this->assertEquals(1,Capacitador::count());
       }

       /** @test */
       public function it_update_capacitador_validation_telefono_integer_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $capacitador = factory(Capacitador::class)->create();

           $this->from(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->put(route('capacitadores.update',['capacitador' => $capacitador]),[
                    'nombre' => 'Lucas',
                    'apellido' => 'Febbroni',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => 'rrr',
                    'sector_id' => $sector->id,
                    'legajo' => '300924',
                    'oficina' => 'Suministros',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
                ])->assertRedirect(route('capacitadores.edit',['capacitador' => $capacitador]))
                ->assertSessionHasErrors(['telefono' => 'El numero de telefono unicamente puede contener numeros']);

               $this->assertEquals(1,Capacitador::count());
       }

    /** @test */
    public function it_delete_capacitador_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $capacitador = factory(Capacitador::class)->create();
        $this->from(route('capacitadores.index'))
        ->delete(route('capacitadores.delete',['capacitador' => $capacitador->id]))->assertRedirect(route('capacitadores.index'))
        ->assertStatus(302);

        $this->assertDatabaseMissing('capacitadores',['id'=>$capacitador->id]);
    }
}
