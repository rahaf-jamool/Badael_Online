<?php

namespace App\Models\PortfolioCategory;

use App\Models\Portfolio\Portfolio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Pcategory extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $primaryKey = 'id';
    protected $table='pcategories';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public $translatedAttributes = ['name'];
    public function PortfolioCategoryTranslation()
    {
        return $this->hasMany(PcategoryTranslation::class , 'pcategory_id');
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
    public static function getAllPortfolio($id)
    {
        return Pcategory::with('portfolios')
            ->where('id', $id)
            ->get();
    }
}
