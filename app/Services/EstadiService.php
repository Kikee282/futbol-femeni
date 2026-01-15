<?php
namespace App\Services;
use App\Repositories\EstadiRepository;
use App\Models\Estadi;

class EstadiService {
    public function __construct(protected EstadiRepository $repo) {}

    public function createEstadi(array $data): Estadi {
        return $this->repo->create($data);
    }
}