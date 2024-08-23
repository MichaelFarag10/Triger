<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\InquiryStatus;
class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'phone2',
        'national_id',
        'date_in',
        'date_pending',
        'date_out',
        'address',
        'address2',
        'code',
        'code2',
        'job',
        'inquiry_type',
        'city',
        'status',
        'reason',
        'journey',
        'journey2',
        'product',
    ];



    public function user(){

        return $this->belongsTo(User::class);
    }
}
