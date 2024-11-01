<?php

namespace App\Models;

use App\Models\User\UserLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function otp()
    {
        return $this->hasOne(OtpToken::class);
    }




    public function vendor()
    {

        if ($this->Boss) {
            return $this->Boss->hasOne(Vendor::class);

        } else {
            return $this->hasOne(Vendor::class);

        }



    }



    public function Boss()
    {
        return $this->belongsTo(User::class, 'boss_id');
    }



    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function rols()
    {
        return $this->belongsToMany(Rol::class);
    }



    public function isAdmin(){
        if($this->rols[0]->name == "admin"){
            return true;
        }
    
        return false; 
    }

    public function scopeFilter($query)
    {

        if (request()->has('sortAge')) {

            $validator = Validator::make(
                request()->all(),
                [
                    'sortAge' => ['string']
                ]
            );

            if (!$validator->fails()) {

                $query->join('profiles', 'profiles.user_id', '=', 'users.id');
                $query->select('users.*');
                if (request()->sortAge == 'down') {
                    $query->orderBy('old');
                }
                if (request()->sortAge == 'up') {
                    $query->orderByDesc('old');
                }

            }

        }

        if (request()->has('gender')) {
            if (in_array(request()->gender, ['male', 'female'])) {
                $query->whereHas('profile', function ($qur) {
                    $qur->where('gender', request()->gender);
                });
            }
        }

        if (request()->has('city')) {
            $validator = Validator::make(
                request()->all(),
                [
                    'city' => ['numeric']
                ]
            );

            if (!$validator->fails()) {
                $city = City::find(request()->city);
                if (!is_null($city)) {
                    $query->whereHas('profile', function ($qur) {
                        $qur->where('city_id', request()->city);
                    });
                }
            }
        }

        if (request()->has('reason')) {
            $validator = Validator::make(
                request()->all(),
                [
                    'reason' => ['numeric']
                ]
            );

            if (!$validator->fails()) {
                $reason = Reason::find(request()->reason);
                if (!is_null($reason)) {
                    $query->whereHas('profile', function ($qur) {
                        $qur->where('reason_id', request()->reason);
                    });
                }
            }
        }

        if (request()->has('age')) {
            $validator = Validator::make(
                request()->all(),
                [
                    'age' => ['array', 'size:2'],
                    'age.*' => ['numeric', 'min:18', 'max:201']
                ]
            );

            if (!$validator->fails()) {

                $query->whereHas('profile', function ($qur) {
                    $qur->whereBetween('old', [request()->age[0], request()->age[1]]);
                });

            }

        }

        return $query;
    }

    public function scopeRolAdmin($query)
    {

        $query->whereHas('rols', function ($qur) {
            $qur->where('name', 'admin');
        });

        return $query;
    }
    public function allAdmins()
    {

        return $this->hasMany(UserRol::class, 'user_id');
    }

    public function scopeRolUser($query)
    {

        $query->whereHas('rols', function ($qur) {
            $qur->where('name', 'user');
        });

        return $query;
    }

    public function scopeVerified($query)
    {
        $query->where('mobile_verified_at', '!=', 'null');
        return $query;
    }

    public function scopeNotVerified($query)
    {
        $query->whereNull('mobile_verified_at');
        return $query;
    }




    public function orders()
    {
        return $this->hasMany(Orders::class)->OrderByDesc('id');
    }





    public function Employers()
    {
        return $this->hasMany(User::class, 'boss_id')->get();
    }


    public function AllEmployers()
    {
        return $this->hasMany(User::class, 'boss_id');
    }



    public function logs()
    {
        return $this->hasMany(UserLog::class)->OrderByDesc('id');
    }




    public function articles()
    {
        return $this->hasMany(UserArticles::class);
    }






}