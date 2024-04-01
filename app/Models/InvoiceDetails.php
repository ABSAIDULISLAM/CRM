<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invsummary()
    {
        return $this->belongsTo(InvoiceSummary::class, 'invoice_summary_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
