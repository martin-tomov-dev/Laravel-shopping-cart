<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getData()
    {
      $json = \File::get('shopdata.json');
      $data = json_decode($json);
      return $data;
    }
}

?>