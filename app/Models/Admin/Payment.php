<?php

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name','phone_number',
        'email','personal_id','unit_unique_reference',
        'total_unit_price','down_payment','valid_hours',
        'address','address2','city','country','user_id','status'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function getTimeFormatedAttribute()
    // {
    //     return Carbon::createFromTimestamp(strtotime($this->updated_at))->diff(Carbon::now())->days;
    // }

}
