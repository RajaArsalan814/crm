<?php

namespace App\Http\Controllers;

use App\Models\SalesTarget;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;

class SalesTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $targets = SalesTarget::all();
        return view('admin.targets.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'sales agent');
            }
        )->get();
        return view('admin.targets.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => 'required',
            'assign_id' => 'required',
        ]);
        try{
            $milestone = round($request->amount/22);

            SalesTarget::create([
                'amount' => $request->amount,
                'milestone' => $milestone,
                'user_id' => Auth()->user()->id,
                'assign_id' => $request->assign_id,
            ]);
            return redirect()->route('targets.index')->with('success', 'Target created Successfully.');
        } catch (\Exception $e) {
            return back()->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $target = SalesTarget::find($id);
        return view('admin.targets.view', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $target = SalesTarget::find($id);
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'sales agent');
            }
        )->get();
        return view('admin.targets.edit', compact('target', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'amount' => 'required',
            'assign_id' => 'required',
        ]);
        try{
            $milestone = $request->amount/22;
            $date = Carbon::now();

            $target = SalesTarget::find($id);
            $target->amount = $request->amount;
            $target->milestone = round($milestone);
            $target->user_id = Auth()->user()->id;
            $target->assign_id = $request->assign_id;
            $target->due_date = $date->addMonth();

            $target->save();

            return redirect()->back()->with('success', 'Target updated Successfully.');
        } catch (\Exception $e) {
            return back()->with('error', json_encode($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesTarget $salesTarget)
    {
        //
    }

    public function sale_agents() {

        $sale_agents = UserRole::with('role','user')->Where('role_id','17')->get();
        return view('sale_agents.index',compact('sale_agents'));
    }

    public function sale_agent_create(){

        $categories= Category::where('status', '=', '1')->get();

        return view('sale_agents.create',compact('categories'));
    }

    public function sale_agents_store(Request $request){

        if ($request->password != $request->confirm_password) {
            return back()->with('error', "Passwords do not match");
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            // 'roles' => 'required',
            // 'category' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->category()->sync($request->category);
        $user->syncRoles($request->get('roles') ?? []);
        $modelKey = $user->getKey();
        Session::flash('laratrust-success', 'Sale Agent Create Successfully');
        return redirect(route('sale_agents.index'));
    }

    public function sale_target_index(){
        $id = Auth::user()->id;
        $targets = SalesTarget::where('assign_id',$id)->get();
        return view('admin.targets.index', compact('targets'));

    }

    public function sale_target_view(){

            $id = Auth::user()->id;
            $target = SalesTarget::where('assign_id',$id)->first();
            return view('admin.targets.view', compact('target'));
    }
}
