<?php

namespace App\Models;

use App\Models\Turbine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'turbine_id',
        'inspected_at',
    ];

    public function turbine(): BelongsTo
    {
        return $this->belongsTo(Turbine::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
