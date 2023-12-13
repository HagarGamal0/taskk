<?php

namespace App\Models;

use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['form_id', 'type', 'question', 'is_required'];

    protected $gaurded=[];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
