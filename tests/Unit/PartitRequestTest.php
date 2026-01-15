<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PartitRequest;

class PartitRequestTest extends TestCase
{
    use RefreshDatabase;
    public function test_validacio_falla_si_gols_son_negatius()
    {
        $request = new PartitRequest();
        
        // Dades incorrectes (gols negatius)
        $data = [
            'gols_local' => -1, 
            'gols_visitant' => 5
        ];

        $validator = Validator::make($data, $request->rules());

        // Ha de fallar
        $this->assertTrue($validator->fails());
        // Ha de tenir error al camp 'gols_local'
        $this->assertTrue($validator->errors()->has('gols_local'));
    }

    public function test_validacio_passa_amb_dades_correctes()
    {
        $request = new PartitRequest();
        
        $data = [
            'gols_local' => 2, 
            'gols_visitant' => 1
        ];

        $validator = Validator::make($data, $request->rules());

        // Ha de passar
        $this->assertFalse($validator->fails());
    }
}