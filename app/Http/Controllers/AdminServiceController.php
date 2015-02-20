<?php namespace App\Http\Controllers;

use Aloha\Twilio\Facades\Twilio;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminServiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
    $orders = Order::all();
		return view('admin/service/index')->withOrders($orders);
	}

  public function getTwilio(Request $request)
  {

    $from = preg_replace('/\\D/', '', $request->get('From'), -1);

    $order = Order::where('phone', $from)->first();

    $order->messages()->create([
      'sender' => 'Customer',
      'message' => $request->get('Body')
    ]);
  }

  public function postMessage($id, Request $request)
  {

    $order = Order::find($id);

    $order->messages()->create([
      'sender' => 'Me',
      'message' => $request->get('message')
    ]);

    $message =  'Main Street Mower: ' . $request->get('message');

    Twilio::message($order->phone, $message);

    return back();
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
