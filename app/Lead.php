<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
	protected $table = 'tbl_leads_list';
	protected $fillable = [ 
		'sales_id', 'client_name', 'company_name', 
		'source', 'entry_date', 'product_id', 
		'add_ons', 'deal_amount', 'stage',
		'expected_close_date', 'actual_close_date', 'closed_amount', 
		'customer_type', 'potential_competitor', 'lose_notes',
		'extra_notes', 'trash',
	];
	public $timestamps = false;

	public function product() {
		return $this->belongsTo(Product::class);
	}

	public function salesperson() {
		return $this->belongsTo(Salesperson::class, 'sales_id');
	}

	public static function notTrashed() {
		return static::where('trash','no');
	}

	public function remarks() {
		return $this->hasMany(LeadsRemark::class, "leads_id");
	}
}
