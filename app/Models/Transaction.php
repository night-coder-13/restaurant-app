<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $guarded = [];
    
    public function getStatusAttribute($status) 
    {
        switch ($status) {
            case '0':
                $status = 'ناموفق';
                break;
            case '1':
                $status = 'موفق';
                break;
        }
        return $status;
    }
}
