<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Model
{
    use  HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dob',
    ];


    protected $casts = [
        'dob' => 'date',
    ];


    // Edad
    public function edad()
    {
        $edad = Carbon::parse($this->dob)->diffInYears();
        return $edad;
    }

    // Proximo Cumpleaños
    public function proximo()
    {
        // $date = Carbon::parse($this->dob);
        // $month = $date->month;
        // $mes = Carbon::parse($date)->locale('es')->isoFormat('MMM');
        // $day = $date->day;
        // $year = Carbon::now()->year;

        // $cadena = $day . '/' . $mes . '/' . $year;

        // return $cadena;

        $year = Carbon::now()->year;
        $dob = Carbon::parse($this->dob);

        return Carbon::parse($year . '-'.$dob->format('m-d'))->diffForHumans();

    }

    


}
