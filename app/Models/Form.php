<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'is_active'];

    public function questions()
    {
        return $this->hasMany(FormQuestion::class);
    }
}
