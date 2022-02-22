<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'category_id'
    ];
}
