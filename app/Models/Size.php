<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    /**
     * Get the ProSize that owns the Size
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ProSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
}
