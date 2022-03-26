<?php

namespace App\Models\PortfolioCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PortfolioCategory extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
    protected $primaryKey = 'id';
    protected $table = 'portfolio_categories';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'name'
    ];
}
