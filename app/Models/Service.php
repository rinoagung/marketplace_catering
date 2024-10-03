<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    // public function getRouteKeyName()
    // {
    //     return "kode_unik";
    // }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where("nama", "like", "%" . $search . "%")
                    ->orwhere("kendala", "like", "%" . $search . "%");
            });
        });

        $query->when($filters["status"] ?? false, function ($query, $status) {
            return $query->where(function ($query) use ($status) {
                $query->where("status", $status);
            });
        });

        $query->when($filters["date"] ?? false, function ($query, $date) {
            return $query->whereDate("created_at", $date);
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function sluggable(): array
    // {
    //     return [
    //         'nama' => [
    //             'source' => 'kode_unik',
    //             'separator' => '',
    //         ]
    //     ];
    // }
}
