<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

  protected $fillable = ['sender', 'message'];

	public function order()
  {
    return $this->belongsTo(Order::class);
  }

}
