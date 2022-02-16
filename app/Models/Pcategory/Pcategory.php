<?php

namespace App\Models\Pcategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table='pcategories';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    protected $fillable = [
        'name'
    ];

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }
}
