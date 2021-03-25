<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
class OrderController extends Controller
{
    private  $orderBook;
    public function __construct(OrderContract $orderBook)
    {
        $this->orderBook =$orderBook;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $order = $this->orderBook->getOrderByActive(1);
        return view('admin.order.index',compact('order'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderAccept($id)
    {
           $this->orderBook->orderAccept($id);
           return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderDelete($id)
    {
        //
    }

}
