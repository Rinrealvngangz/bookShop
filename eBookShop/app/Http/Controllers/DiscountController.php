<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use Illuminate\Http\Request;
use App\Models\Discount;
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discount = Discount::all();
        return view('admin.discount.index',compact('discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountRequest $request)
    {
          $input = $request->all();
          $name = ucfirst($input['name']);
          $input['name'] =$name;
          Discount::create($input);
           session()->flash('success','Create sucess!');
          return redirect()->route('discount.index');
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
        $discount =  Discount::findOrFail($id);

          return view('admin.discount.edit',compact('discount'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountRequest $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $input = $request->all();
        $name = ucfirst($input['name']);
        $input['name'] =$name;
        $check =  Discount::where('name', '=', $input['name'])->exists();
         if (!$check ||$check && $input['name'] === $discount->name) {
                 $discount->name = $input['name'];
                 $discount->value =$input['value'];
                 $discount->save();
          }else{
              return redirect()->back()->withErrors('Name discount is exists!');
          }
          session()->flash('update','Update success!');
          return redirect()->route('discount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::destroy($id);
        session()->flash('delete','Delete Success!');
       return redirect()->route('discount.index');
    }
}
