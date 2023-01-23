<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\CustomerField;
use Barryvdh\DomPDF\Facade\Pdf;




class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customer=Customer::create($request->customer);
        // $data = new Invoice();
        // $data->invoice_number = $request->invoice['invoice_number'];
        // $data->invoice_date = $request->invoice['invoice_date'];
        // $data->customer_id = $customer->id;
        // $data->tax_percent = $request->invoice['tax_percent'];
        // $data->save();
         $invoice=Invoice::create($request->invoice +['customer_id'=> $customer->id]);

         for($i=0; $i< count($request->product);$i++){
            if (isset($request->qty[$i])&& isset($request->price[$i])){
                InvoiceItem::create([
                    'invoice_id'=> $invoice->id,
                    'name'=> $request->product[$i],
                    'quantity'=> $request->qty[$i],
                    'price'=> $request->price[$i],
                ]);

            }
            }

            for($i=0; $i< count($request->customer_fields);$i++){
                // dd($request->customer_fields[$i]);
                if (isset($request->customer_fields[$i]['field_key']) || isset($request->customer_field[$i]['field_value'])){
                    // dd($customer);
                    CustomerField::create([
                        'customer_id'=> $customer->id,
                        'field_key'=> $request->customer_fields[$i]['field_key'],
                        'field_value'=> $request->customer_fields[$i]['field_value'],
                    ]);
                }
                }
        return 'To be Continued';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);

        return view('invoices.show',compact('invoice'));
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

    public function download($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        // PDF::loadView('invoices.pdf',compact('invoice'))->output();


        $pdf = \Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->stream('invoice.pdf');
       }

}
