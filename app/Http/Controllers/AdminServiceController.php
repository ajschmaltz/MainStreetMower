<?php namespace App\Http\Controllers;

use Aloha\Twilio\Facades\Twilio;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminServiceController extends Controller {

  public function getIndex()
  {
    return view('admin/service/index');
  }

  public function getOrders()
  {
    return Order::with('messages')->get();
  }

  public function getTwilio(Request $request)
  {

    $from = substr($request->get('From'), 2);

    $order = Order::where('phone', $from)->first();

    if ($order) { // there was an order in the system with that phone number

      $order->messages()->create([
        'sender' => 'Customer',
        'message' => $request->get('Body')
      ]);

    } else { // there was not an order in the system with that form number

      $order = Order::create([
        'tag' => 'xxx',
        'phone' => $from
      ]);

      $order->messages()->create([
        'sender' => 'Customer',
        'message' => $request->get('Body')
      ]);

    }


  }

  public function postMessage(Request $request)
  {

    $order = Order::find($request->get('id'));

    $order->messages()->create([
      'sender' => 'Me',
      'message' => $request->get('message')
    ]);

    $message =  'Main Street Mower: ' . $request->get('message');

    Twilio::message($order->phone, $message);

  }

  public function postOrder(Request $request)
  {

    Order::create([
      'tag' => $request->get('tag'),
      'phone' => $request->get('phone')
    ]);

    return back();
  }

  public function getDelete($id)
  {
    Order::destroy($id);

    return back();
  }

}
