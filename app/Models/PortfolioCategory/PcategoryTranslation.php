<?php

namespace App\Models\PortfolioCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcategoryTranslation extends Model
{
    use HasFactory;
    protected $table='pcategory_translations';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
