<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lead extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'source' => $this->source,
            'product' => $this->product->product_name,
            'deal_amount' => $this->deal_amount,
            'product_id' => $this->product_id,
            'stage' => $this->stage,
            'sales_id' => $this->sales_id,
            'salesperson' => $this->salesperson,
            'company_name' => $this->company_name,
            'entry_date' => $this->entry_date,
            'add_ons' => $this->add_ons,
            'expected_close_date' => !empty($this->expected_close_date) ? date('Y-m-d', strtotime($this->expected_close_date) ): null,
            'actual_close_date' => !empty($this->actual_close_date) ?  date('Y-m-d', strtotime($this->actual_close_date)) : null,
            'closed_amount' => $this->closed_amount,
            'customer_type' => $this->customer_type,
            'potential_competitor' => $this->potential_competitor,
            'lose_notes' => $this->lose_notes,
            'extra_notes' => $this->extra_notes,
            'trash' => $this->trash,
            $this->client_name,
            $this->source,
            $this->product->product_name,
            $this->deal_amount,
            $this->stage,
            $this->product_id,
        ];
    }
}
