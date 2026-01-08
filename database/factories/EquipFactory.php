<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipFactory extends Factory
{
    protected $model = Equip::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->company,
            'ciutat' => $this->faker->city,
            'pressupost' => $this->faker->numberBetween(1000000, 10000000),
            'titols' => $this->faker->numberBetween(0, 50),
            
            // Usamos ?->id para evitar errores si first() devuelve null, y el operador ?? para crear uno nuevo
            'estadi_id' => Estadi::inRandomOrder()->first()?->id ?? Estadi::factory(),
        ];
    }
}