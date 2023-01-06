<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\Brands;
use App\Models\Status;
use App\Models\Services;
use Auth;
use App\Imports\ImportLeads;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index() {

        $sale_agent_id=Auth::user()->id;
        $leads = Leads::with('brand','service')->where('user_id',$sale_agent_id)->get();
        return view('leads.lead',compact('leads'));
    }

    public function lead_create() {
        $brands = Brands::get();
        $services = Services::get();
        // $status = Status::select('id', 'name')->get();
        return view('leads.create',compact('brands','services'));
    }

    public function lead_store(Request $request){

        $lead = new Leads;
        $lead->first_name = $request->first_name;
        $lead->last_name = $request->last_name;
        $lead->email = $request->email;
        $lead->contact = $request->contact;
        $lead->brand = $request->brand;
        $lead->service = $request->service;
        $lead->user_id = Auth::user()->id;
        $lead->save();
        return redirect()->route('leads')->with('success', "Client Create successfully");
    }

    public function import(Request $request){
        $user_id= auth()->user()->id;
        Excel::import(new ImportLeads ($user_id),
                      $request->file('file')->store('files'));
        return redirect()->back();
    }
}
