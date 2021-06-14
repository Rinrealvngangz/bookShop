<?php

namespace App\Http\Controllers;

use App\Contracts\HomeContract;
use App\Contracts\ReviewContract;
use App\Http\Requests\RequestRating;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private  $homeContract;
    private  $reviewContract;
    public function __construct(HomeContract $homeContract,ReviewContract $reviewContract)
    {
             $this->homeContract =$homeContract;
             $this->reviewContract =$reviewContract;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $products =  $this->homeContract->getAll();

        $productsSale  =  $this->homeContract->getProductSale();
        $productsChildren =  $this->homeContract->getProductChildren();
          $productsManga =$this->homeContract->getProductManga();
        $productsSeriesManga =$this->homeContract->getProductSeriesManga();
        $productsBestSell =$this->homeContract->productBestSell();
        $productsKinhTe =$this->homeContract->productKinhTe();
        return view('app.overview',compact('products','productsSale','productsKinhTe',
            'productsChildren','productsManga','productsSeriesManga','productsBestSell'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function findProduct(Request $request){
        $products  =  $this->homeContract->getAll();
        global $product;
        if( $request->name !== null ){
            $product = $this->homeContract->findProduct($request);
            if($product === false){

                return view('app.productNotFound',compact('products'));
            }else{
                return view('app.product', compact('product','products'));
            }

        }else{
            return view('app.productNotFound',compact('products'));
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function getByCategory(Request $request,$name,$id)
    {

        $products  =  $this->homeContract->getAll();
        global $product;
        if ($request->ajax()) {
            global $product;
            if ($request->has('sort')) {
                $key = $request->input('sort');
                $product = $this->homeContract->sortPriceById($name, $id, $key);
            } elseif ($request->has('sortname')) {

                $key = $request->input('sortname');
                $product = $this->homeContract->sortNameById($name, $id, $key);
            } elseif ($request->has('sortFormality')) {

                $key = $request->input('sortFormality');
                $product = $this->homeContract->sortFormalityById($name, $id, $key);

            } else {

                $product = $this->homeContract->getByProductByCategory($name, $id);

            }

            return response()->json($product);
        } else {
            $query = $request->query->all();
            if(array_key_exists('show',$query) && count($query) ===1){

                $product = $this->homeContract->getByCategory($name, $id, $query['show']);
                return view('app.product', compact('product','products'));
            }else if (array_key_exists('show',$query) && count($query)){
                 global $keys;
                if(array_key_exists('sort',$query)){
                             $keys = $query['sort'];
                    }
                    else if(array_key_exists('sortname',$query)){
                    $keys = $query['sortname'];
                }else{
                    $keys = $query['sortFormality'];
                }
                    $product = $this->homeContract->showRecordWithSort($name, $id, $query['show'],$keys);
                return view('app.product', compact('product','products'));
                }
            if ($request->has('sort')) {
                $key = $request->input('sort');

                $product = $this->homeContract->getByCategory($name, $id, $key);
            } elseif ($request->has('sortname')) {
                $key = $request->input('sortname');
                $product = $this->homeContract->getByCategory($name, $id, $key);
            } elseif ('sortFormality') {
                $key = $request->input('sortFormality');

                $product = $this->homeContract->getByCategory($name, $id, $key);
            } else {
                $product = $this->homeContract->getByCategory($name, $id, "");
            }

        }

        return view('app.product', compact('product','products'));
    }
        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @param string $name
         * @return \Illuminate\Http\Response
         */
        public function getProduct(Request $request ,string $name,$id)
       {
           $products =  $this->homeContract->getAll();
           $productDetail = $this->homeContract->getProductDetail($name,$id);
           $arrAjaxInfoBook =array();

           array_push($arrAjaxInfoBook,$productDetail->getDescribe());
           array_push($arrAjaxInfoBook,$productDetail->getPrice());
           array_push($arrAjaxInfoBook,$productDetail->getTitle());
           array_push($arrAjaxInfoBook,$productDetail->getPublisher());
           array_push($arrAjaxInfoBook,$productDetail->getOriginalPrice());
           array_push($arrAjaxInfoBook,$productDetail->getPercentDiscount());
           array_push($arrAjaxInfoBook,$productDetail->getFormality());
           array_push($arrAjaxInfoBook,$productDetail->getAuthor());
           array_push($arrAjaxInfoBook,$productDetail->getPublisher());
           array_push($arrAjaxInfoBook,$productDetail->getlistImages());
           array_push($arrAjaxInfoBook,$productDetail->getReviewBest());
           array_push($arrAjaxInfoBook,$productDetail->getReviewNumberStar());
           if ($request->ajax()) {
               return response()->json($arrAjaxInfoBook);
           }

           return view('app.productDetail',compact('products','productDetail'));
       }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function getProductNew(){
      $products =  $this->homeContract->getAll();
      $productsBestSell =$this->homeContract->getPoductByType("new");
      if($productsBestSell === null){
          return view('app.productNotFound',compact('products'));
      }
      return view('app.productType',compact('productsBestSell','products'));
  }

    public function getProductSale(){
        $products =  $this->homeContract->getAll();
        $productsBestSell =$this->homeContract->getPoductByType("sale");
        if($productsBestSell === null){
            return view('app.productNotFound',compact('products'));
        }
        return view('app.productType',compact('productsBestSell','products'));
    }


    public function getProductHot(){
        $products =  $this->homeContract->getAll();
        $productsBestSell =$this->homeContract->getPoductByType("hot");
        if($productsBestSell === null){
            return view('app.productNotFound',compact('products'));
        }
        return view('app.productType',compact('productsBestSell','products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function reviewProduct(RequestRating $request, $id){
                   $result =   $this->reviewContract->postReview($request,$id);
                   session()->flash('review-success',$result);
                   return redirect()->back();
    }

}
