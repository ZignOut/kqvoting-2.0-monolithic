<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    /** nominee path */
    public function path()
    {
        return '/nominees/' . $this->id;
    }
}
