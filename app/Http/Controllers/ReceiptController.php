<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\ReceiptDetail;
use App\Models\RentDetail;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $client_id = $request->client_id;
        $receipts = Receipt::where('client_id',$client_id)
                        ->orderBy('id','desc')
                        ->paginate(10);
        return $receipts;
    }//.index

    public function store(Request $request)
    {
        $rcp = $request->receipt;

        $receipt = new Receipt();
        $receipt->client_id   = $rcp['client_id'];
        $receipt->type        = $rcp['type'];
        $receipt->description = $rcp['description'];
        $receipt->observation = $rcp['observation'];
        $receipt->status      = $rcp['status'];
        $receipt->payment     = $rcp['payment'];
        $receipt->subtotal    = $rcp['subtotal'];
        $receipt->discount    = $rcp['discount'];
        $receipt->received    = $rcp['received'];
        $receipt->total       = $rcp['total'];
        $receipt->discount_concept = $rcp['discount_concept'];
        $receipt->save();

        $details = json_decode($request->detail);

        foreach($details as $data){
            $detail = new ReceiptDetail();
            $detail->receipt_id  = $receipt->id;
            $detail->descripcion = $data->name;
            $detail->qty         = $data->qty;
            $detail->price       = $data->cost;
            $detail->subtotal    = $data->subtotal;
            $detail->save();
        }

        $eq_new_counts = json_decode($request->eq_new_counts);
        foreach($eq_new_counts as $enc){
            $rent_equipo = RentDetail::findOrFail( $enc->equipo_id);
            if($rent_equipo->monochrome)
                $rent_equipo->counter_mono  =  $enc->equipo_new_count_monochrome;
            if($rent_equipo->color)
                $rent_equipo->counter_color =  $enc->equipo_new_count_color;

            $rent_equipo->save();
        }

        return response()->json([
            'ok'=>true,
            'receipt' => $receipt,
        ]);
    }

    public function test(Request $reques){
        /*
        //$var = "[{"cost":52,"qty":1,"name":"Luis"},{"cost":51,"qty":1,"name":"Luigi Bros"}]";
        //$var = json_decode($reques->detail);
        $var = json_decode($reques->detail);
        foreach($var as $detail){
            echo $detail->name.', '.$detail->qty.'<br>';
        }*/
    }

    public function update(Request $request, Receipt $receipt)
    {
        //
    }


    public function destroy(Receipt $receipt)
    {
        //
    }
}
