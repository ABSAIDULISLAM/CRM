<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLead extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'next_contact_date', // Add next_contact_date to the $dates array
        // Add other date attributes if needed
    ];

    public function lead()
    {
        return $this->belongsTo(ContactLead::class, 'lead_id', 'id');
    }

}
