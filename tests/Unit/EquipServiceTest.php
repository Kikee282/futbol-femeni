<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\EquipService;
use App\Repositories\EquipRepository;
use App\Models\Equip;
use Mockery;

class EquipServiceTest extends TestCase
{
    use RefreshDatabase;
    public function test_pot_crear_un_equip_mitjancant_el_servei()
    {
        // 1. PREPARAR (Arrange)
        // Simulem (Mock) el Repository perquè no toqui la base de dades real
        $repositoryMock = Mockery::mock(EquipRepository::class);
        
        $dadesEquip = [
            'nom' => 'Girona FC',
            'ciutat' => 'Girona',
            'pressupost' => 500000
        ];
        
        $equipEsperat = new Equip($dadesEquip);

        // Esperem que el mètode 'create' del repo es cridi una vegada
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with($dadesEquip)
            ->andReturn($equipEsperat);

        // Injectem el mock al servei
        $service = new EquipService($repositoryMock);

        // 2. EXECUTAR (Act)
        $resultat = $service->createEquip($dadesEquip);

        // 3. VERIFICAR (Assert)
        $this->assertEquals('Girona FC', $resultat->nom);
    }
    
    // Neteja els mocks després de cada test
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}