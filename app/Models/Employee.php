<?php

namespace App\Models;

use App\Models\Company;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guard_name= 'web';
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone'];

    protected $perPage = 10;


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
