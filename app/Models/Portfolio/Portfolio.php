<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Portfolio extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $primaryKey = 'id';
    protected $table='portfolios';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public $translatedAttributes = ['name', 'client','desc'];
    protected $fillable = [
        'slug',
        'pcategory_id',
        'cover',
        'mobileImage',
        'link',
        'date',
    ];
    public function PortfolioTranslation()
    {
        return $this->hasMany(PortfolioTranslation::class , 'portfolio_id');
    }

    public function pcategory()
    {
        return $this->belongsTo(Pcategory::class);
    }
}
