<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ToffeeProduct;
use App\Repositories\MyBlDigitalServiceRepository;
use App\Repositories\ToffeeProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ToffeeProductController extends Controller
{
    public  $toffeeProductRepository;
    public function __construct(ToffeeProductRepository $toffeeProductRepository)
    {
        $this->toffeeProductRepository = $toffeeProductRepository;
    }

    public function index()
    {
        $products = $this->toffeeProductRepository->findAll();
        return view('admin.toffee-product.index', compact('products'));
    }


    public function create()
    {
        return view('admin.toffee-product.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
//        dd($data);
        if (!empty($data['image'])) {
            $data['image'] = 'storage/' . $data['image']->store('toffee-product-image');
        }

        $flag = $this->toffeeProductRepository->save($data);

        if ($flag) {
            Session::flash('message', 'Product Create successful');
        }
        else{
            Session::flash('danger', 'Product Create Failed');
        }

        return redirect('toffee-product');
    }


    public function edit(ToffeeProduct $toffeeProduct)
    {
        $product = $toffeeProduct;
        return view('admin.toffee-product.edit', compact('product'));
    }


    public function update(Request $request, ToffeeProduct $toffeeProduct)
    {
        $data = $request->all();
        if (!empty($data['image'])) {
            $data['image'] = 'storage/' . $data['image']->store('toffee-product-image');
        }

        $flag = $toffeeProduct->update($data);
//        dd($data);
        if ($flag) {
            Session::flash('message', 'Product Update successful');
        }
        else{
            Session::flash('danger', 'Product Update Failed');
        }

        return redirect('toffee-product');

    }


    public function destroy($id)
    {
        return $this->toffeeProductRepository->destroy($id);
    }
}
