<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  protected $fillable = ['tag', 'phone'];

	public function messages()
  {
    return $this->hasMany(Message::class);
  }

}
