<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\JugadoraService;
use App\Repositories\JugadoraRepository;
use App\Models\Jugadora;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;

class JugadoraServiceTest extends TestCase {
    use RefreshDatabase;

    public function test_pot_crear_jugadora_amb_foto() {
        Storage::fake('public'); // Simulamos el disco duro
        $repoMock = Mockery::mock(JugadoraRepository::class);
        
        $foto = UploadedFile::fake()->create('avatar.png');
        $dades = ['nom' => 'Alexia', 'dorsal' => 11, 'equip_id' => 1];
        
        // Esperamos que al repositorio le llegue la key 'foto' con un hash (la ruta)
        $repoMock->shouldReceive('create')
                 ->once()
                 ->with(Mockery::on(function($arg) {
                     return isset($arg['foto']); // Verificamos que se añadió la foto
                 }))
                 ->andReturn(new Jugadora($dades));

        $service = new JugadoraService($repoMock);
        $service->createJugadora($dades, $foto);
        
        // Verificamos que la foto se guardó "físicamente" en el disco falso
        $this->assertNotEmpty(Storage::disk('public')->allFiles('jugadores'));
    }

    protected function tearDown(): void {
        Mockery::close();
        parent::tearDown();
    }
}