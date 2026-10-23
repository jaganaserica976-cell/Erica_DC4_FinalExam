<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    //
    protected $fillable = [
        'student_id',
        'class_id',
        'prelimgrade',
        'midtermgrade', 
        'final_average',
        'remarks',
    ];
    protected $casts = [
        'prelimgrade' => 'decimal:2',
        'midtermgrade' => 'decimal:2',
        'final_average' => 'decimal:2',
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
