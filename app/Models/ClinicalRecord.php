<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'staff_member_id',
        'appointment_id',
        'record_date',
        'summary',
        'diagnosis',
        'treatment',
        'recommendations',
    ];

    protected $casts = [
        'record_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
