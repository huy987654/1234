<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    /** @use HasFactory<\Database\Factories\TypeFactory> */
    use HasFactory;

    public function getAllTypes(): \Illuminate\Support\Collection
    {
        $type = DB::table('types')
            ->get();
        return $type;
    }
}
