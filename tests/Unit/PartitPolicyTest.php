<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use App\Policies\PartitPolicy;

class PartitPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pot_editar_qualsevol_partit()
    {
        $admin = new User(['role' => 'admin']);
        $partit = new Partit(['arbitre' => 'Altre Arbitre']);
        
        $policy = new PartitPolicy();
        
        // L'admin hauria de poder (true)
        $this->assertTrue($policy->update($admin, $partit));
    }

    public function test_arbitre_pot_editar_el_seu_partit()
    {
        $arbitre = new User(['id' => 2, 'role' => 'arbitre', 'name' => 'Mateu']);
        // Simulem un partit assignat a aquest àrbitre
        $partit = new Partit(['arbitre' => 'Mateu']); 

        $policy = new PartitPolicy();
        $this->assertTrue($policy->update($arbitre, $partit));
    }

    public function test_arbitre_no_pot_editar_partit_d_altri()
    {
        $arbitre = new User(['id' => 2, 'role' => 'arbitre', 'name' => 'Mateu']);
        $partit = new Partit(['arbitre' => 'Gil Manzano']); // Un altre àrbitre

        $policy = new PartitPolicy();
        $this->assertFalse($policy->update($arbitre, $partit));
    }
}