<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\Brands;
use App\Models\Status;
use Auth;

class LeadController extends Controller
{
    public function index() {

        $sale_agent_id=Auth::user()->id;
        $leads = Leads::with('brand')->where('user_id',$sale_agent_id)->get();
        return view('leads.lead',compact('leads'));
    }

    public function lead_create() {
        $brands = Brands::get();
        // $status = Status::select('id', 'name')->get();
        return view('leads.create',compact('brands'));
    }

    public function lead_store(Request $request){

        $lead = new Leads;
        $lead->first_name = $request->first_name;
        $lead->last_name = $request->last_name;
        $lead->email = $request->email;
        $lead->contact = $request->contact;
        $lead->brand_id = $request->brand_id;
        $lead->user_id = Auth::user()->id;
        $lead->save();
        return redirect()->route('leads')->with('success', "Client Create successfully");
    }
}
