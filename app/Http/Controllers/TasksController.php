<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $tasks = Task::latest()->paginate(5);
        
        return view('tasks.index',compact('tasks'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validated=validator()->make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'complete'=>'required',
             'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            'duedate'=>'required'
        ],
   [
    'title.required'=> 'Your Title is Required', // custom message
    ]
       
    );
       // dd($request->all());
       if($validated->fails())
       {
        return response()->json(["errors"=>$validated->errors()]);
       }
       
            if ($request->hasFile('image'))
              {
                $image = $request->file('image');
                $filename = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $filename);
                $post=Task::create([
                "title" => $request->title,
                "description" => $request->description,
                "image" => $filename,
                "complete"=>$request->complete,
                "due_date"=>$request->duedate

            ]);

           return response()->json(['success' => 'New task details added successfully']);
        
    

             }




        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tasks=Task::find($id);
        return view('tasks.show', compact('tasks'));
    }
    public function edit(string $id)
    {
        $tasks=Task::find($id);
        return view('tasks.edit', compact('tasks'));

    }
    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $updateid=Task::find($id);
        $validated=validator()->make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'complete'=>'required',
                   
            'duedate'=>'required'
        ],
   [
    'title.required'=> 'Your Title is Required', // custom message
    ]
       
    );
       // dd($request->all());
       if($validated->fails())
       {
        return response()->json(["errors"=>$validated->errors()]);
       }
       
            if ($request->hasFile('image'))
              {
                $image = $request->file('image');
                $filename = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $filename);
                $post=Task::where('id', $id)->update([
                "title" => $request->title,
                "description" => $request->description,
                "image" => $filename,
                "is_completed"=>$request->complete,
                "due_date"=>$request->duedate

            ]);

           return response()->json(['success' => 'Updated task details successfully']);

              }
              else
              {
                $post=Task::where('id', $id)->update([
                "title" => $request->title,
                "description" => $request->description,
                "is_completed"=>$request->complete,
                "due_date"=>$request->duedate

            ]);

           return response()->json(['success' => 'Updated task details successfully']);
                
              }
                
        

    }
    


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
         
        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully');
    }
}
