<?php

namespace App\Http\Controllers;

use App\Contracts\AdminContract;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private  $adminContract;
    public function __construct(AdminContract $adminContract)
    {
        $this->adminContract =$adminContract;
    }
    public function index()
    {
        $overviewOrderModel = $this->adminContract->getAll();
        return view('admin.overview-order',compact('overviewOrderModel'));
    }

}
