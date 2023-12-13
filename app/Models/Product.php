<?php

namespace App\Models;

use App\Models\User;
use App\Models\SelelctedProductOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','user_id','apperance'];

    public function selectedOptions(): HasMany
    {
        return $this->hasMany(SelelctedProductOption::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function getImageAttribute($value): String
    {
      return  'storage/'. $value;
    }
}
