<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use Ramsey\Uuid\Uuid;
use App\Models\Note;
use Carbon\Carbon;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Note::orderBy('reminder','asc')->get();
        
        return response()->json(['data' => $data], 200); 
    }

    // public function count(){
    //     $data = Note::count();
        
    //     return response()->json(['data' => $data], 200); 
    // }

    // public function get_data($take, $skip){
    //     $data = Note::take($take)->skip($skip)->get();
        
    //     return response()->json(['data' => $data], 200); 
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $req = $request->validated();
        $req['uuid'] = Uuid::uuid4()->getHex();
        $req['user_id'] = auth()->user()->uuid;
        $req['reminder'] = Carbon::parse($req['reminder'])->format('Y-m-d');
        $data = Note::create($req);

        return response()->json(['message' => 'Data has been created.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Note::find($id);

        if(!$data){
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        return response()->json(['data' => $data], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, string $id)
    {
        $req = $request->validated();
        $req['reminder'] = Carbon::parse(now())->format('Y-m-d');
        // $data = Note::where('uuid',$id)->update($req);
        Note::where('uuid',$id)->update($req);

        // $data = Note::where('uuid',$id)->first();

        // return response()->json(['message' => $request], 200);
        return response()->json(['message' => 'Data has been updated.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Note::where('uuid', $id)->delete();

        return response()->json(['message' => 'Data has been deleted.'], 200);
    }
}
