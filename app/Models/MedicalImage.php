<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'medical_history_id',
        'image_type',
        'image_url',
        'description',
        'image_date',
    ];

    protected $casts = [
        'image_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_url'];

    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->image_url);
    }

    public function medicalHistory()
    {
        return $this->belongsTo(MedicalHistory::class);
    }
}
