<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $table = 'menus';

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where("nama", "like", "%" . $search . "%");
            });
        });
    }
}
