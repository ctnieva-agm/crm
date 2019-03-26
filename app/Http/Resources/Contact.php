<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // created an array with numeric index and char for the rease DataTable ajax wanted numeric indexed array
    public function toArray($request)
    {
        return [
            'member_vip_number' =>  $this->member_vip_number,
            'full_name' =>  $this->full_name,
            'email' =>  $this->email,
            'company_name' =>  isset($this->info->company_name) ? $this->info->company_name : '',
            'phone_number' =>  isset($this->info->phone_number) ? $this->info->phone_number : '',
            'date_registered' =>  $this->date_registered,
            'source' =>  $this->source,
            'id' =>  $this->id,
            'birthday' =>  isset($this->info->birthday) ? $this->info->birthday : '',
            'gender' =>  isset($this->info->gender) ? $this->info->gender : '',
            'nationality' =>  isset($this->info->nationality) ? $this->info->nationality : '',
            'address' =>  isset($this->info->address) ? $this->info->address : '',
            'system_id' =>  $this->system_id,
            'company_address' =>  isset($this->info->company_address) ? $this->info->company_address : '',
            'position' =>  isset($this->info->position) ? $this->info->position : '',
            'sponsored_by' =>  $this->sponsored_by,
            'notes' =>  isset($this->info->notes) ? $this->info->notes : '',
            $this->member_vip_number,
            $this->full_name,
            $this->email,
            isset($this->info->company_name) ? $this->info->company_name : '',
            isset($this->info->phone_number) ? $this->info->phone_number : '',
            $this->date_registered,
            $this->source,
            
        ];
    }
}
