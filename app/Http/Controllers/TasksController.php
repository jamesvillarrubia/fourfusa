<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Helpers\Transformers\TaskTransformer;
use App\Task;
use Auth;
use Socialite;



class TasksController extends ApiController
{




    protected $taskTransformer;


    function __construct(TaskTransformer $taskTransformer)
    {

        $this->taskTransformer = $taskTransformer;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        if (Auth::check()){
            $id = Auth::id();

            $tasks = Task::where('user_id',$id)->orderBy('id','asc')->get();
            $tasks = $this->taskTransformer->transformCollection($tasks->toArray());
            return view('pages.nested')->with('tasks',$tasks);
     
        }

        return redirect()->to('/');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $input = $request->all();
            $tasks = $input['tasks'];
            $tasks = $this->taskTransformer->untransformCollection($tasks);


            foreach($tasks as $task){
                $task = Task::firstOrNew(array('id' => 70,'user_id'=>51));

                $task = $this->taskTransformer->untransformCollection($task);
                
                $task->save();
                return $this->respond(['tasks' => $task]);
            }

            if(is_array($input)){
        //        return $this->respond(['data' => 'is_array']);
            }
        //    return $this->respond(['data' => $input]);
        }
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        
        if ( ! $task){

            return $this->responseNotFound('Task not found!');
        
        }

        return $this->respond([
            'data'  =>  $this->taskTransformer->transformCollection([$task])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }




}
