<?php
namespace App\Repositories;
use App\Models\Estadi;

class EstadiRepository {
    public function create(array $data): Estadi {
        return Estadi::create($data);
    }
    public function delete($id): bool {
        return Estadi::destroy($id);
    }
}