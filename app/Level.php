<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  protected $table = 'tb_level';
  public $primaryKey = 'id';
  public $timestamps = false;
}
