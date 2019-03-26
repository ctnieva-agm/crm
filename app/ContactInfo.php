<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'tbl_contacts_info';
    protected $fillable = [
        'user_id', 'gender', 'birthday',
        'nationality', 'address','company_name',
        'company_address', 'position', 'notes',    
    ];

    public $timestamps = false;

    public function contact() {
        return $this->belongsTo(Contact::class, 'user_id');
    }
}
