<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\InvoiceHeader;
use App\InvoiceDetail;
use PDF;

class InvoicesController extends Controller
{
    
    public function index()
    {
       return view('Invoices.create');
    }

    public function create()
    {
       return view('Invoices.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, [ 
          'invoice_name' => 'required|max:255',
          'total_qty' => 'required|numeric|min:1', 
          'subtotal' => 'required|numeric|min:1',
          'tax' => 'required|numeric|min:0',
          'total' => 'required|numeric|min:1',
          'Details.*.Item' => 'required|max:255',
          'Details.*.price' => 'required|numeric|min:1',
          'Details.*.quantity' => 'required|integer|min:1',
          'Details.*.amount' => 'required|integer|min:1'
      ]);

      $details = collect($request->Detail)->transform(function($detail) {            
            return new InvoiceDetail($detail);
      });   

      $invoiceHeader = $request->except('Detail','_token');     
      $invoice = InvoiceHeader::create($invoiceHeader);            
      $invoice->Invoices()->saveMany($details);

      return view('Invoices.create');      
    }

    public function show()
    {   
        $search=\Request::get('search');     
        $invoices = InvoiceHeader::Where('invoice_name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);        
        return view('Invoices.show',compact('invoices'));       
    }
    
    public function edit($id)
    {
        $header = InvoiceHeader::with('Invoices')->find($id);              
        return view('Invoices.Update',compact('header'));       
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [ 
          'invoice_name' => 'required|max:255',
          'total_qty' => 'required|numeric|min:1', 
          'subtotal' => 'required|numeric|min:1',
          'tax' => 'required|numeric|min:0',
          'total' => 'required|numeric|min:1',
          'Details.*.Item' => 'required|max:255',
          'Details.*.price' => 'required|numeric|min:1',
          'Details.*.quantity' => 'required|integer|min:1',
          'Details.*.amount' => 'required|integer|min:1'
        ]);

        $invoiceHeader = InvoiceHeader::find($id);
        $invoice = $request->except('Detail','_token');
        $invoiceHeader->update($invoice); 

        $details = collect($request->Detail)->transform(function($detail) {            
              return new InvoiceDetail($detail);
        });

        InvoiceDetail::where('invoice_header_id', $id)->delete();

        $invoiceHeader->Invoices()->saveMany($details);

        return redirect('invoices/show');
    }

    
    public function destroy($id)
    {
        InvoiceDetail::where('invoice_header_id', $id)->delete();
        InvoiceHeader::where('id', $id)->delete();
        return redirect('invoices/show');
    }

    public function pdf($id)
    {
      $data = InvoiceHeader::with('Invoices')->find($id);         
      view()->share('data',$data);        
      $pdf = PDF::loadView('Invoices.Print');      
      return $pdf->download('Invoice.pdf');      
    }
}
