<?php

namespace App\Imports;

use App\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ContactsImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        // if (!isset($row[0]) || $row[0] == 'full_name' ) {
        //     return null;
        // }

        // while(true) {
		// 	$vip = 'xxxx-'.rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999);
        //     $checkVIP = Contact::where('member_vip_number', $vip)->first();
		// 	if($checkVIP == null) {
		// 		break;
		// 	}
        // }

        // return new Contact([
        //     'member_vip_number' => $vip,
        //     'full_name' => $row[0],
        //     'email' => $row[1],
        //     'system_id' => $row[2],
        //     'phone_number' => $row[3],
        //     'date_registered' => $row[4],
        //     'status' => $row[5],
        //     'sponsored_by' => $row[6],
        //     'source' => $row[7],
        //     'date_sync' => date('Y-m-d H:i:s'),
        //     'save_activation_date' => date('Y-m-d H:i:s'),
        //     'update_vip_number' => '',
        //     'subscription' => 'subscribed',
        // ]);
    }
}
