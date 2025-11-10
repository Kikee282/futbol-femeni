<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartitsController extends Controller
{
    public $partits = [
        ['local' => 'Barça Femení', 'visitant' => 'Atlètic de Madrid', 'data' => '2024-11-30', 'resultat' => ''],
        ['local' => 'Real Madrid Femení', 'visitant' => 'Barça Femení', 'data' => '2024-12-15', 'resultat' => '0-3'],
    ];
}
