<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Brands;
use App\Models\Status;
use App\Models\User;
use App\Models\Packages;
use App\Models\Services;
use App\Models\Currencies;
use App\Models\Invoices;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTemplate;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use App\Models\Leads;
use App\Models\MyClient;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::user()->hasPermission('client-access')) abort(403);
        $clients = Clients::with('user')->orderBy('id','DESC')->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::user()->hasPermission('add-client')) abort(403);
        $brands = Brands::select('id', 'name')->get();
        $status = Status::select('id', 'name')->get();
        return view('admin.clients.create', compact('brands', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'brand' => 'required',
            'status' => 'required',
        ]);
        // Client create
        try {
            # check user if match with database user
            $users = User::where('email', $request->email)->get();

            # check if email is more than 1
            if(sizeof($users) > 0){
                return back()->with('error', $e->getMessage('This email already in user user !'));
            }

            // $user = new User;
            // $user->name = $request->first_name;
            // $user->last_name = $request->last_name;
            // $user->contact = $request->contact;
            // $user->password = NULL;
            // $user->email = $request->email;
            // $user->save();

            // if($user){

            $client = new Clients;
            $client->name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->contact = $request->contact;
            $client->email = $request->email;
            $client->brand_id = $request->brand;
            $client->status = $request->status;
            $client->save();
            // }

            return back()->with('success', "Client Create successfully");
        } catch (\Exception $e) {
            return back()->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients, $id)
    {

        //
        if (!Auth::user()->hasPermission('show-client')) abort(403);
        $client = Clients::find($id);
        $clientpaid = Invoices::groupBy('currency')->where('payment_status', '=', '1')->where('client_id', '=', $id)->select('currency',  \DB::raw('sum(amount) as amount'))->get();
        $clientunpaid = Invoices::groupBy('currency')->where('payment_status', '=', '0')->where('client_id', '=', $id)->select('currency',  \DB::raw('sum(amount) as amount'))->get();

        return view('admin.clients.view', compact('client', 'clientpaid', 'clientunpaid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (!Auth::user()->hasPermission('edit-client')) abort(403);
        $client = Clients::find($id);
        $brands = Brands::all();
        $status = Status::select('id', 'name')->get();
        return view('admin.clients.edit', compact('status', 'brands', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required|max:16',
            'brand' => 'required',
            'status' => 'required',
        ]);

        # check user if match with database user
        $users = User::where('email', $request->email)->get();

        # check if email is more than 1
        if(sizeof($users) > 0){
            return back()->with('error', $e->getMessage('This email already in user user !'));
        }

        try {
            $clients = Clients::find($id);
            $clients->name = $request->first_name;
            $clients->last_name = $request->last_name;
            $clients->contact = $request->contact;
            $clients->email = $request->email;
            $clients->brand_id = $request->brand;
            $clients->status = $request->status;
            $clients->save();


            return back()->with('success', "Update successfully");
        } catch (\Exception $e) {
            return back()->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }

    public function clientregister(Request $request, $id)
    {
        if (!Auth::user()->hasPermission('register-client')) abort(403);
        $request->validate([
            'password' => 'required',
        ]);

        try {
            $client = Clients::find($id);

            $user = User::where('email', '=', $client->email)->first();
            if ($user === null) {
                $user =  new User();
                $user->name = $client->name;
                $user->email = $client->email;
                $user->password = Hash::make($request["password"]);
                $user->is_employee = '1';
                $user->save();
                if($user){
                    Clients::where('id',$client->id)->update(['user_id'=>$user->id]);
                }
                $user->attachRole('client');

                Mail::to($client->email)->send(new MailTemplate("
                Hello!
                Welcome to ".env("APP_NAME")." - ".$client->name."
                You are one step closer to making your business more organized
                Your registered email-id is ".$client->email." you can now login in our portal
                If you have any questions do not hesitate to reach out at ".env("APP_EMAIL")));

                return back()->with('success', "Client Password Inserted");
            }else{
                return back()->with('error', "User Already Created");
            }

            $user->attachRole('client');
            $user->password = Hash::make($request["password"]);
            $user->save();

            return back()->with('success', "Client Password Updated");
        } catch (\Exception $e) {
            return back()->with('error', json_encode($e->getMessage()));
        }
    }

    public function lead($id)
    {
        if (!Auth::user()->hasPermission('create-lead')) abort(403);

        $client = Clients::find($id);
        $packages = Packages::all();
        $currencies = Currencies::all();
        $services = Services::all();

        return view('admin.clients.lead', compact('packages', 'currencies', 'services', 'client'));
    }

    public function lead_to_client(){
        $leads = Leads::get();
        return view('client.create',compact('leads'));
    }

    public function client_store(Request $request){



        $lead_id = $request->lead_id;
        $lead = Leads::where('id',$lead_id)->first();
        $m_clients = MyClient::where('email',$lead->email)->first();
        if(isset($m_clients)){
            return back()->with('error', 'This client is  already created !');
        }else{
        $client = new MyClient;
        $client->name = $lead->first_name;
        $client->last_name = $lead->last_name;
        $client->email = $lead->email;
        $client->contact = $lead->contact;
        $client->user_id = Auth::user()->id;
        $client->status = '0';
        $client->save();
        return redirect()->route('client_adds')->with('success', "Client Create successfully");
        }
    }

    public function client_adds(){

        $clients = MyClient::where('user_id',Auth::user()->id)->get();
        return view('client.clients',compact('clients'));
    }



}
