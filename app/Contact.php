<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "tbl_contacts";

    protected $fillable = [ 
        'member_vip_number', 'full_name', 'email', 
        'system_id', 'phone_number', 'date_registered', 
        'status', 'sponsored_by', 'date_sync',
        'save_activation_date', 'source', 'update_vip_number', 
        'subscription'
    ];

    protected static function boot() {
        parent::boot();
    }

    public $timestamps = false;

    public function info() {
        return $this->hasOne(ContactInfo::class, 'user_id');
    }
}
