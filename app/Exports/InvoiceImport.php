<?php

namespace App\Exports;

use App\Models\Invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceImport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoices = Invoices::all();
        $invoice_data = array();
        foreach($invoices as $invoice){
            $data = [
                'name' => $invoice->name,
                'email' => $invoice->email,                
                'contact' => $invoice->contact,                
                'brand' => $invoice->brand,                
                'service' => $invoice->service,                
                'package' => $invoice->package,                
                'currency' => $invoice->currency,                
                'invoice_number' => $invoice->invoice_number,    
                'invoice_date' => $invoice->invoice_date,                
                'sales_agent_id' => $invoice->sales_agent_id,                
                'description' => $invoice->description,                  
                'amount' => $invoice->amount,                
                'payment_status' => $invoice->payment_status,            
                'payment_type' => $invoice->payment_type,                
                'custom_package' => $invoice->custom_package,            
                'transaction_id' => $invoice->transaction_id,                
            ];

            array_push($invoice_data, $data);
        }

        return collect($invoice_data);
    }
    public function headings() : array
    {
        return [
            'Name',
            'Email',
            'Contact',
            'Brand',
            'Service',
            'Package',
            'Currency',
            'Invoice Number',
            'Invoice Date',
            'Sales Agent',
            'Description',
            'Amount',
            'Payment Status',
            'Payment Type',
            'Package Name',
            'Transaction Id'
        ];
    }
}