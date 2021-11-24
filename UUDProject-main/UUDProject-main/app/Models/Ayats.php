<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasals;

class Ayats extends Model
{
    use HasFactory;
    protected $table = "ayats";
    protected $fillable = ['pasal', 'ayat', 'bunyi'];
    public function pasals()
    {
        return $this->belongsTo(Pasals::class, 'pasal');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('ayat', 'like', '%' . $search . '%')
                ->orWhere('pasal', 'like', '%' . $search . '%')
                ->orWhere('bunyi', 'like', '%' . $search . '%');
        });
    }
}
