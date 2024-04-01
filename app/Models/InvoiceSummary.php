<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceSummary extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function invdetails()
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_summary_id', 'id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }




    



}
