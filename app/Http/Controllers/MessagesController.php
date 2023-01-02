<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Messages;
use App\Models\MessageFiles;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::user()->hasPermission('messages-access')) abort(403);
        $users = User::all();
        $messages = Messages::latest()->get()->unique('name');
        return view('admin.messages.allmessages', compact('messages', 'users'));
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
            'message' => 'required'
        ]);

        $data = [
            'name' => Auth::user()->name,
            'message' => $request->message,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
        ];

        $messages =  Messages::create([
            'name' => Auth::user()->name,
            'message' => $request->message,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
        ]);
        
        if ($request->file('files')) {
            $files = [];
            foreach ($request->file('files') as $key => $file) {
                $fileName = time() . rand(1, 99) . '.' . $file->extension();
                $file->move(public_path('files'), $fileName);
                $files[]['name'] = $fileName;
            }
            foreach ($files as $file) {
                foreach ($file as $f) {
                    MessageFiles::create([
                        'file' => $f,
                        'message_id' => $messages->id,
                    ]);
                }
            }
        }


        return redirect()->back()->with('success', 'Inserted Successfully');
    }

    public function show($id)
    {
        //
        if (!Auth::user()->hasPermission('messages-access')) abort(403);
        $messages = Messages::where('sender_id', $id)->orwhere('reciver_id', $id)->latest()->get();
        return view('admin.messages.index', compact('messages'));
    }
}