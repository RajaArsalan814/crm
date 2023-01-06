<?php

namespace App\Imports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportLeads implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
        private $id;

    public function  __construct($id)
    {

        $this->id =$id;
    }

    public function model(array $row)
    {

        return new Leads([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'email' => $row[2],
            'contact' => $row[3],
            'brand' => $row[4],
            'service' => $row[5],
            'user_id' => $this->id,
        ]);
    }
}
