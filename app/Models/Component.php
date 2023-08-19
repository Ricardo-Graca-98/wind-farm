<?php

namespace App\Models;

use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'component_type_id',
        'turbine_id',
    ];

    public function componentType(): BelongsTo
    {
        return $this->belongsTo(ComponentType::class);
    }

    public function turbine(): BelongsTo
    {
        return $this->belongsTo(Turbine::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
