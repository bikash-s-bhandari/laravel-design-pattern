<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/** @use HasFactory<\Database\Factories\CompanyFactory> */
class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
