<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rules() {
        //dd($this->id);
        return [            
            'name' => 'required|max:60|min:3',
            'email' => 'required|min:6|max:60!unique:users,email,'.$this->id,
            'password' => 'required|min:3|max:10|confirmed'
        ];
    }

    public function feedback() {
        return [
            'password.required' => 'O campo senha é obrigatório', 
            'required' => 'O campo :attribute é obrigatório', 
            'email.unique' => 'E-mail já existe',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.',
            'confirmed' => 'A confirmação da senha não confere.'                             
        ];
    }    
}
