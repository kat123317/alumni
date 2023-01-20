<?php

namespace App\Imports;

use App\Models\Graduate;
use Maatwebsite\Excel\Concerns\ToModel;

class GraduatesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Graduate([
            'yearbook_id'=>$row[1],
            'college_id'=>$row[2],
            'course_id'=>$row[3],
            'firstname'=>$row[4],
            'middlename'=>$row[5],
            'lastname'=>$row[6],
            'suffix'=>$row[7],
            'details->moto'=>$row[8],
            'details->achievements'=>explode(', ',$row[9]),
            'details->profile_picture'=>$row[10]
        ]);
    }
}
