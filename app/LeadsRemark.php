<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadsRemark extends Model
{
    protected $table = "tbl_leads_remark";
    protected $fillable = [ 
        "leads_id",
        "description",
        "status",
        "title",
        "to_be_done",
        "doing",
        "done",
    ];

    public $timestamps = false;
}
