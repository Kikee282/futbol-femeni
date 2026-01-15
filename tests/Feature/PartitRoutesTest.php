<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;

class PartitRoutesTest extends TestCase
{
    // Reinicia la BD per a cada test
    use RefreshDatabase; 

    public function test_qualsevol_usuari_pot_veure_llistat_partits()
    {
        // Act: Fem petició GET a la ruta index
        $response = $this->get(route('partits.index'));

        // Assert: Codi 200 (OK)
        $response->assertStatus(200);
        $response->assertSee('Llistat de Partits');
    }

    public function test_usuari_no_login_no_pot_editar_partit()
    {
        // Preparem dades mínimes per crear un partit (necessitem equips i estadi per les claus foranes)
        $estadi = Estadi::factory()->create();
        $local = Equip::factory()->create(['estadi_id' => $estadi->id]);
        $visitant = Equip::factory()->create(['estadi_id' => $estadi->id]);
        
        $partit = Partit::create([
            'local_id' => $local->id, 
            'visitant_id' => $visitant->id,
            'estadi_id' => $estadi->id,
            'data' => now(),
            'arbitre' => 'Àrbitre Test'
        ]);

        // Act: Intentem entrar a editar sense login
        $response = $this->get(route('partits.edit', $partit));

        // Assert: Redirecció al login (302)
        $response->assertStatus(302); 
    }

    public function test_admin_pot_veure_editar_partit()
    {
        // 1. Arrange: Creem admin i partit
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Creació ràpida de dependències
        $estadi = Estadi::factory()->create();
        $local = Equip::factory()->create(['estadi_id' => $estadi->id]);
        $visitant = Equip::factory()->create(['estadi_id' => $estadi->id]);

        $partit = Partit::create([
            'local_id' => $local->id, 
            'visitant_id' => $visitant->id,
            'estadi_id' => $estadi->id,
            'data' => now(),
            'arbitre' => 'Un altre'
        ]);

        // 2. Act: Login com admin i accés
        $response = $this->actingAs($admin)
                        ->get(route('partits.edit', $partit));

        // 3. Assert: 200 OK
        $response->assertStatus(200);
    }
}