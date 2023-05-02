<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBasico extends Model
{
    use HasFactory;    

    public function campos() {
        return $this->fillable;
    }

}
