<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Contracts\HomeContract;
class OrderController extends Controller
{
    private  $orderBook;
    private  $homeContract;
    public function __construct(OrderContract $orderBook,HomeContract $homeContract)
    {
        $this->orderBook =$orderBook;
        $this->homeContract =$homeContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = $this->orderBook->getAll();
        return view('admin.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,  $customer)
    {

    }
    /**
     * Display the specified resource.
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderShow($id, $customer)
    {

       $item = $this->orderBook->orderShow($id,$customer);
      return view('admin.order.overview',compact("item"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $result = $this->orderBook->update($request,$id);
       if( $result === "Update date success"){
           $request->session()->flash('update-status',$result);
       }
        return redirect()->route('order.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderDelete($id,$userId){
        $result = $this->orderBook->destroy($id);
        return response()->json(['result'=>$result]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderConfirm(){
        $order = $this->orderBook->getOrderByActive(0);
        return view('admin.order.request',compact('order'));
    }



}
