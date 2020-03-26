<?php

namespace App\Models;

require_once '../config/Database.php';

use Database;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model 

{

    protected $table = 'pacientes';

}
