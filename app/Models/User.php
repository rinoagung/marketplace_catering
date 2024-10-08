<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\HakAkses;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ["id"];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function hakAkses()
    {
        return $this->belongsTo(HakAkses::class, "hak_akses_id");
    }

    public function getRouteKeyName()
    {
        return "username";
    }


    public function scopeFilter($query, array $filters)
    {

        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where("nama", "like", "%" . $search . "%")
                    ->orwhere("username", "like", "%" . $search . "%");
            });
        });
    }
}
