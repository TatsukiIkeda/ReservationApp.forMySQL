<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        //ログインユーザ情報を取得
        $user = Auth::user();
        //DBからデータを取得
        $items = Order::all();
        return view('order.index')
        ->with(['items' => $items,'user' => $user]);
    }


    public function selectdate(Request $request)
    {
        //ログインユーザ情報を取得
        $user = Auth::user();
        // $sort = $request->stat;
        //選択した日付を取り出す
        $date =  $request->selectdate;
        //DBからデータを取得
        $items = Order::all();
        return view('order/selectdate')
        ->with(['items' => $items,'date' => $date,'user' => $user]);
    }

    public function create(Request $request)
    {
        //ログインユーザ情報を取得
        $user = Auth::user();
        //DBからデータを取得
        $items = Order::all();
        return view('order/create')
        ->with(['items' => $items,'user' => $user]);
    }

    public function store(Request $request)
    {
        //ログインユーザ情報を取得
        $user = Auth::user();
        //入力したデータを変数$paramに入れる
        $order = new Order();
        $order->order_name = $user->name;
        $order->arrival_date = $request->arrival_date;
        $order->title = $request->title;
        $order->vendor = $request->vendor;
        $order->quantity = $request->quantity;
        $order->memo = $request->memo;
        $order->flg = '1';
        $order->save();

        return  redirect('order');
    }

    public function edit(Request $request, $order_id)
    {
        //ログインユーザ情報を取得
        $user = Auth::user();
        //受け取った$order_idから対象のレコードを呼び出す
        $item = Order::where('order_id', $order_id)->firstOrFail();
        // $item = DB::table('ordres')->where('order_id', $order_id)->first();
        return view('order/edit')
        ->with(['item' => $item,'user' => $user,'order_id' => $order_id]);
    }

//変数に代入したデータを指定したレコードに保存する
    public function update(Request $request)
    {
        $order = Order::find($request->input('order_id'));//Order::find($request->$order_id);ではレコードを取得できない。
        $order->order_name = $request->order_name;
        $order->arrival_date = $request->arrival_date;
        $order->title = $request->title;
        $order->vendor = $request->vendor;
        $order->quantity = $request->quantity;
        $order->memo = $request->memo;
        $order->flg = '1';
        $order->save();
        return redirect('order');
    }

    //削除ボタンを押した時の処理
    public function del(Request $request, $order_id)
    {
        //受け取った$order_idから対象のレコードを呼び出す
        $order = Order::where('order_id', $order_id)->firstOrFail();
        $order->delete();
        return redirect('order');
    }

    //入荷状況を変更する時の処理、入荷済みに変更
    public function instock(Request $request, $order_id)
    {

        $order = Order::find($request->input('order_id'));//Order::find($request->$order_id);ではレコードを取得できない。
        $order->flg = '0';
        $order->save();
        //受け取った$order_idから対象レコードをflgデータを上書きする
        return redirect('order');
    }

    //入荷状況を変更する時の処理、未入荷に変更
    public function notinstock(Request $request, $order_id)
    {
        $order = Order::find($request->input('order_id'));
        //変更するflgを変数$paramに入れる
        $order->flg = '1';
        //受け取った$order_idから対象レコードをflgデータを上書きする
        $order->save();



        return redirect('order');
    }




    public function logout()
    {
        //ログアウトする
        Auth::logout();
        return redirect('order');
      }


}
