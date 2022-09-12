<?php

namespace App\Models;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\HasRoles;

class Company extends Model

{
    use HasRoles;
    protected $guard_name= 'web';
    use HasFactory;
    protected $fillable = ['name', 'email', 'logo', 'website'];

    protected $perPage = 10;
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}

