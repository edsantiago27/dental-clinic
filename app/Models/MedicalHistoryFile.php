<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalHistoryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_history_id',
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'description',
    ];

    protected $appends = ['url'];

    public function medicalHistory(): BelongsTo
    {
        return $this->belongsTo(MedicalHistory::class);
    }

    /**
     * Obtener URL completa del archivo
     */
    public function getUrlAttribute(): string
    {
        return url('storage/' . $this->file_path);
    }
}