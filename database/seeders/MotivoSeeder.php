<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motivo;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Copia Certificada de Acta y Registro de Titulo de Grado', 
            'precio' => '0.053'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Copia Certificada de Acta y Registro de Titulo de Grado',
            'precio' => '0.143'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Certificación de titulo', 
            'precio' => '0.053'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Certificación de titulo',
            'precio' => '0.143'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Certificación de programa', 
            'precio' => '0.107'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Certificación de programa',
            'precio' => '0.178'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Constancia de prosecución o modalidad de estudio', 
            'precio' => '0.053'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Constancia de prosecución o modalidad de estudio',
            'precio' => '0.143'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Constancia de servicio comunitario', 
            'precio' => '0.053'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Notas certificadas', 
            'precio' => '0.107'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Notas certificadas',
            'precio' => '0.178'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Record académico', 
            'precio' => '0.160'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Record académico',
            'precio' => '0.214'
        ]);
	    Motivo::create([
            'tipo' => 'nacional',
            'nombre' => 'Certificación del perfil de egresado por competencias', 
            'precio' => '0.053'
        ]);

        Motivo::create([
            'tipo' => 'internacional',
            'nombre' => 'Certificación del perfil de egresado por competencias',
            'precio' => '0.143'
        ]);
        
    }
}
