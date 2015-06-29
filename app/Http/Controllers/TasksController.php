<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Helpers\Transformers\TaskTransformer;
use App\Task;



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

        $tasks = Task::all();
        $tasks = $this->taskTransformer->transformCollection( $tasks->toArray());
        return view('pages.nested')->with('tasks',$tasks);
 
 /*
        return $this->respond([
            'data'  =>  $this->taskTransformer->transformCollection( $tasks->toArray() )
        ]);
*/
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
    public function store()
    {

       /* if (! Input::get('title'))
        {

            $this->setStatusCode(422)
                 ->respondWithError('Validation Failed.');

        }*/
        //dd('store');
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
