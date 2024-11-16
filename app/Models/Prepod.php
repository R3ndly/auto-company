<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prepod extends Model
{
    // Укажите таблицу, если имя модели не соответствует имени таблицы
    protected $table = 'prepods';

    // Укажите поля, которые могут быть массово назначены
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'age',
        'phone',
        'salary',
        'experience',
    ];
}
