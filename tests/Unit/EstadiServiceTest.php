<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\EstadiService;
use App\Repositories\EstadiRepository;
use App\Models\Estadi;
use Mockery;

class EstadiServiceTest extends TestCase {
        use RefreshDatabase;

    public function test_pot_crear_estadi() {
        $repoMock = Mockery::mock(EstadiRepository::class);
        $dades = ['nom' => 'Camp Nou', 'capacitat' => 99000];
        
        $repoMock->shouldReceive('create')->once()->with($dades)->andReturn(new Estadi($dades));

        $service = new EstadiService($repoMock);
        $resultat = $service->createEstadi($dades);

        $this->assertEquals('Camp Nou', $resultat->nom);
    }
    
    protected function tearDown(): void {
        Mockery::close();
        parent::tearDown();
    }
}