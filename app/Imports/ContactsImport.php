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
        
    }
}
