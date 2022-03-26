<?php

namespace App\Models\Portfolio;

use App\Models\PortfolioCategory\PortfolioCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Portfolio extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'client', 'desc'];
    protected $primaryKey = 'id';
    protected $table = 'portfolios';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'name',
        'client',
        'desc',
        'slug',
        'portfolio_category_id',
        'cover',
        'mobileImage',
        'link',
        'date',
    ];

    public function PortfolioCategory ()
    {
        return $this->belongsTo (PortfolioCategory::class,'portfolio_category_id');
    }
}
