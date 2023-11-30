<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
            'nome','phone','email','address',
            'namerefone','namereftwo','phonerefone',
            'phonereftwo','description', 'type',
            'status','shift','username',
            'password','newuser'
        ];
    public function rules(){
        return[
            'name' => 'require:unique:employees,name',
            'phone' =>'require',
            'email' => 'require',
            'birth' => 'require',
            'address' =>'require',
            'namerefone' =>"nullable",
            'namereftwo' =>'nullable',
            'phonerefone' =>'nullable',
            'phonereftwo' =>'nullable',
            'restriction' =>'nullable',
            'description' =>'nullable',
            'document' =>'nullable',
            'type' =>'require',
            'status' =>'require',
            'shift' =>'nullable',
            'username' =>'require:unique:employees,username',
            'password' =>'nullable',
            'newuser' =>'nullable',
        ];
    }
    public function feedback(){
        return[

        ];
    }

}
