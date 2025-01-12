<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
  protected $guarded = ['id'];

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function scopeExpenses($query)
  {
    return $query->whereHas('category', function ($query) {
      $query->where('is_expense', true);
    });
  }

  public function scopeIncomes($query)
  {
    return $query->whereHas('category', function ($query) {
      $query->where('is_expense', false);
    });
  }
}
