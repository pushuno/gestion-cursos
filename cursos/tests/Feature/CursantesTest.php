<?php

namespace Tests\Feature;

use App\Cursante;
use App\NivelEstudio;
use App\Sector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CursantesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_ok_test()
    {
        $response = $this->get(route('cursantes.index'))
            ->assertStatus(200)
            ->assertSee('Cursantes');
    }

    /** @test */
    public function it_create_cursante_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '08/08/2008',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.index'))
            ->assertStatus(302);

            $this->assertEquals(1,Cursante::where('nombre','Lucas')->count());
    }

    /** @test */
    public function it_create_cursante_validation_nombre_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => '',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '08/08/2008',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_create_cursante_validation_apellido_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => '',
                'fecha_ingreso' => '08/08/2008',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['apellido' => 'El apellido es obligatorio']);

            $this->assertEquals(0,Cursante::count());
    }

     /** @test */
     public function it_create_cursante_validation_fecha_ingreso_required_test()
     {
         $nivel = factory(NivelEstudio::class)->create();
         $sector = factory(Sector::class)->create();

         $this->from(route('cursantes.new'))
             ->post(route('cursantes.add'),[
                 'nombre' => 'Lucas',
                 'apellido' => 'Febbroni',
                 'fecha_ingreso' => '',
                 'fecha_nacimiento' => '20/03/1988',
                 'numero_documento' => '33597840',
                 'nivel_estudio_id' => $nivel->id,
                 'titulo' => 'Ing. Informatica',
                 'email' => 'damianfe@hotmail.com',
                 'telefono' => '1559712417',
                 'sector_id' => $sector->id,
                 'direccion' => 'calle falsa 123',
                 'categoria' => '3',
                 'afiliado' => '35195',
                 'afiliado_barra' => '1'
             ])->assertRedirect(route('cursantes.new'))
             ->assertSessionHasErrors(['fecha_ingreso' => 'La fecha de ingreso es obligatoria']);

             $this->assertEquals(0,Cursante::count());
     }

    /** @test */
    public function it_create_cursante_validation_fecha_nacimiento_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '20/03/1988',
                'fecha_nacimiento' => '',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['fecha_nacimiento' => 'La fecha de nacimiento es obligatoria']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_create_cursante_validation_numero_documento_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '20/03/1988',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['numero_documento' => 'Debe ingresar el número de documento']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_create_cursante_validation_nivel_estudio_required_test()
    {
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '20/03/1988',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => '',
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['nivel_estudio_id' => 'El nivel de estudio alcanzado es obligatorio']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_create_cursante_validation_sector_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '20/03/1988',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => '1559712417',
                'sector_id' => '',
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['sector_id' => 'Debe especificar el sector al que pertenece el capacitador']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_create_cursante_validation_telefono_required_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $this->from(route('cursantes.new'))
            ->post(route('cursantes.add'),[
                'nombre' => 'Lucas',
                'apellido' => 'Febbroni',
                'fecha_ingreso' => '20/03/1988',
                'fecha_nacimiento' => '20/03/1988',
                'numero_documento' => '33597840',
                'nivel_estudio_id' => $nivel->id,
                'titulo' => 'Ing. Informatica',
                'email' => 'damianfe@hotmail.com',
                'telefono' => 'rrr',
                'sector_id' => $sector->id,
                'direccion' => 'calle falsa 123',
                'categoria' => '3',
                'afiliado' => '35195',
                'afiliado_barra' => '1'
            ])->assertRedirect(route('cursantes.new'))
            ->assertSessionHasErrors(['telefono' => 'El numero de telefono unicamente puede contener numeros']);

            $this->assertEquals(0,Cursante::count());
    }

    /** @test */
    public function it_update_cursante_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();
        $cursante = factory(Cursante::class)->create();
        $this->from(route('cursantes.edit',['cursante' => $cursante]))
        ->put(route('cursantes.update',['cursante' => $cursante]),[
            'nombre' => 'Lucas',
            'apellido' => 'Febbroni',
            'fecha_ingreso' => '08/08/2008',
            'fecha_nacimiento' => '20/03/1988',
            'numero_documento' => '33597840',
            'nivel_estudio_id' => $nivel->id,
            'sector_id' => $sector->id
        ])->assertRedirect(route('cursantes.index'))
        ->assertStatus(302);

        $this->assertEquals(1,Cursante::where('nombre','Lucas')->where('id',$cursante->id)->count());

    }


       /** @test */
       public function it_update_cursante_validation_nombre_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();
           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => '',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '08/08/2008',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
               ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
               ->assertSessionHasErrors(['nombre' => 'El nombre es obligatorio']);

               $this->assertEquals(1,Cursante::count());
       }

       /** @test */
       public function it_update_cursante_validation_apellido_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => '',
                   'fecha_ingreso' => '08/08/2008',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
               ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
               ->assertSessionHasErrors(['apellido' => 'El apellido es obligatorio']);

               $this->assertEquals(1,Cursante::count());
       }

        /** @test */
        public function it_update_cursante_validation_fecha_ingreso_required_test()
        {
            $nivel = factory(NivelEstudio::class)->create();
            $sector = factory(Sector::class)->create();

            $cursante = factory(Cursante::class)->create();

            $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                    'nombre' => 'Lucas',
                    'apellido' => 'Febbroni',
                    'fecha_ingreso' => '',
                    'fecha_nacimiento' => '20/03/1988',
                    'numero_documento' => '33597840',
                    'nivel_estudio_id' => $nivel->id,
                    'titulo' => 'Ing. Informatica',
                    'email' => 'damianfe@hotmail.com',
                    'telefono' => '1559712417',
                    'sector_id' => $sector->id,
                    'direccion' => 'calle falsa 123',
                    'categoria' => '3',
                    'afiliado' => '35195',
                    'afiliado_barra' => '1'
                ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
                ->assertSessionHasErrors(['fecha_ingreso' => 'La fecha de ingreso es obligatoria']);

                $this->assertEquals(1,Cursante::count());
        }

       /** @test */
       public function it_update_cursante_validation_fecha_nacimiento_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '20/03/1988',
                   'fecha_nacimiento' => '',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
               ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
               ->assertSessionHasErrors(['fecha_nacimiento' => 'La fecha de nacimiento es obligatoria']);

               $this->assertEquals(1,Cursante::count());
       }

       /** @test */
       public function it_update_cursante_validation_numero_documento_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '20/03/1988',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
               ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
               ->assertSessionHasErrors(['numero_documento' => 'Debe ingresar el número de documento']);

               $this->assertEquals(1,Cursante::count());
       }

       /** @test */
       public function it_update_cursante_validation_nivel_estudio_required_test()
       {
           factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '20/03/1988',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => '',
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
                ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
                ->assertSessionHasErrors(['nivel_estudio_id' => 'El nivel de estudio alcanzado es obligatorio']);

               $this->assertEquals(1,Cursante::count());
       }

       /** @test */
       public function it_update_cursante_validation_sector_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           factory(Sector::class)->create();
           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '20/03/1988',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => '1559712417',
                   'sector_id' => '',
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
                ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
                ->assertSessionHasErrors(['sector_id' => 'Debe especificar el sector al que pertenece el capacitador']);

               $this->assertEquals(1,Cursante::count());
       }

       /** @test */
       public function it_update_cursante_validation_telefono_required_test()
       {
           $nivel = factory(NivelEstudio::class)->create();
           $sector = factory(Sector::class)->create();

           $cursante = factory(Cursante::class)->create();

           $this->from(route('cursantes.edit',['cursante' => $cursante]))
               ->put(route('cursantes.update',['cursante' => $cursante]),[
                   'nombre' => 'Lucas',
                   'apellido' => 'Febbroni',
                   'fecha_ingreso' => '20/03/1988',
                   'fecha_nacimiento' => '20/03/1988',
                   'numero_documento' => '33597840',
                   'nivel_estudio_id' => $nivel->id,
                   'titulo' => 'Ing. Informatica',
                   'email' => 'damianfe@hotmail.com',
                   'telefono' => 'rrr',
                   'sector_id' => $sector->id,
                   'direccion' => 'calle falsa 123',
                   'categoria' => '3',
                   'afiliado' => '35195',
                   'afiliado_barra' => '1'
                ])->assertRedirect(route('cursantes.edit',['cursante' => $cursante]))
                ->assertSessionHasErrors(['telefono' => 'El numero de telefono unicamente puede contener numeros']);

               $this->assertEquals(1,Cursante::count());
       }

    /** @test */
    public function it_delete_cursante_test()
    {
        $nivel = factory(NivelEstudio::class)->create();
        $sector = factory(Sector::class)->create();

        $cursante = factory(Cursante::class)->create();
        $this->from(route('cursantes.index'))
        ->delete(route('cursantes.delete',['cursante' => $cursante->id]))->assertRedirect(route('cursantes.index'))
        ->assertStatus(302);

        $this->assertDatabaseMissing('cursantes',['id'=>$cursante->id]);
    }
}
