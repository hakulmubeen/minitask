<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Models\Billing;
use App\Mail\BillingEmail;
use App\Models\BilledProduct;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('billing.index',compact('products'));
    }
    public function generate(Request $request){
        $validators=Validator::make($request->all(),[
            'email'=>'required',
            'cash'=>'required',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,product_id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'five_hundred' => 'nullable|integer|min:1|required_without_all:fifty,twenty,ten,five,two,one',
            'fifty' => 'nullable|integer|min:1|required_without_all:five_hundred,twenty,ten,five,two,one',
            'twenty' => 'nullable|integer|min:1|required_without_all:five_hundred,fifty,ten,five,two,one',
            'ten' => 'nullable|integer|min:1|required_without_all:five_hundred,fifty,twenty,five,two,one',
            'five' => 'nullable|integer|min:1|required_without_all:five_hundred,fifty,twenty,ten,two,one',
            'two' => 'nullable|integer|min:1|required_without_all:five_hundred,fifty,twenty,ten,five,one',
            'one' => 'nullable|integer|min:1|required_without_all:five_hundred,fifty,twenty,ten,five,two',
        ]);
        if(!$validators->fails()){
            DB::beginTransaction();
            $billing = new Billing();
            $billing->email = $request->email;
            $billing->five_hundred = $request->five_hundred;
            $billing->fifty = $request->fifty;
            $billing->twenty = $request->twenty;
            $billing->ten = $request->ten;
            $billing->five = $request->five;
            $billing->two = $request->two;
            $billing->one = $request->one;
            $billing->cash = $request->cash;
            $billing->save();
            // remove repeated values and add it to existing value
            $products = [];
            foreach ($request->product_id as $index => $productId) {
                $quantity = $request->quantity[$index];
                if (isset($products[$productId])) {
                    $products[$productId] += $quantity; 
                } else {
                    $products[$productId] = $quantity; 
                }
            }

            $productIds = array_keys($products);
            $quantities = array_values($products);
            foreach ($productIds as $key => $value) {
                $product = Product::where('product_id',$value)->first();
                if(isset($product) && $quantities[$key] > $product->available_qty)
                {
                    DB::rollBack();
                    $response_data = ["success" => 0, "message" => $product->name . " has only ". $product->available_qty . " in quantity"];
                    return response()->json($response_data);
                }
                $billed_product = new BilledProduct();
                $billed_product->billing_id = $billing->id;
                $billed_product->product_id = $value;
                $billed_product->quantity = $quantities[$key];
                $billed_product->save();
                
                $product->available_qty = $product->available_qty - $quantities[$key];
                $product->save();
            }
            DB::commit();
            Mail::to($billing->email)->queue(new BillingEmail($billing));
            $response_data = ["success" => 1, "message" =>"Bill Generated Successfully", "id" => $billing->id];
        } else{
            $errors = array_values(Arr::dot($validators->errors()->toArray()));
            $response_data = ["success" => 0, "message" => "validation error", "error" => $errors];
        }
        return response()->json($response_data);
    }
    public function generated($id){
        $billing_totals = [];
        $bill = Billing::with('billedProducts.product')->find($id);
        if(isset($bill))
        {
            $billing_totals = $bill->calculateBillingDetails($bill);
            $denomination = $bill->calculateDenominations($billing_totals['balance_payable']);
        }
        return view('billing.generated',compact('bill','billing_totals','denomination'));
    }
    public function list(Request $request)
    {
        $list = Billing::all();
        return view('billing.list',compact('list'));
    }
}
