<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadiController extends Controller
{
    public $estadis = [
        ['nom' => 'Estadi Johan Cruyff', 'Ubicació' => 'Sant Joan Despi', 'capacitat' => 6000, 'equip' => 'FC Barcelona Femení'],
        ['nom' => 'Centro Deportivo Wanda Alcalá de Henares', 'Ubicació' => 'Alcalá de Henares', 'capacitat' => 2800, 'equip' => 'Atlètic de Madrid Femení'],
        ['nom' => 'Estadio Alfredo Di Stéfano', 'Ubicació' => 'Madrid', 'capacitat' => 6000, 'equip' => 'Real Madrid Femení'],
    ];
    

    

    public function index(){

    }
}
