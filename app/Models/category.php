<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table='category';
    protected $_fillable=['name','parentId','description','status','slug'];
    protected $guarded=['_token'];
}
