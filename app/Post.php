<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'post';
    protected $fillable = [
      'name',
      'file',
      'description',
      'location',
    ];
    public $timestamps = false;
    protected $dates = [
      'created_at',
      'updated_at'
    ];

    /*
    * Method untuk yang mendefinisikan relasi antara model post dan model user
    */
    public function getUserObject()
    {
        return $this->belongsToMany(User::class);
    }

    public function getLocationObject()
    {
        return $this->belongsToMany(Location::class);
    }

    public function getReportObject()
    {
        return $this->belongsToMany(Report::class);
    }

    public function getComments()
    {
      return $this->hasMany(comment::class);
    }
}
