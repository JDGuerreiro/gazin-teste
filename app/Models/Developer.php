<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Level;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'name', 'gender', 'birthdate', 'hobby'];

    protected $appends = ['age'];

    public function getAgeAttribute()
    {
       return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function level()
    {
        return $this->hasOne(Level::class, 'level_id');
    }
}
