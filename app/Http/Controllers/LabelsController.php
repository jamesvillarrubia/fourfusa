<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Helpers\Transformers\LabelTransformer;
use App\Label;
use App\Task;

class LabelsController extends ApiController
{

    protected $labelTransformer;


    function __construct(LabelTransformer $labelTransformer)
    {
        $this->labelTransformer = $labelTransformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($taskId = null)
    {

        $labels = $this->getLabels($taskId);

        return $this->respond([
            'data' => $this->labelTransformer->transformCollection($labels->toArray())
        ]);
        
    }


    public function getLabels($taskId){
      
     //   $results = Task::find($taskId);
       // dd($results);
        //->labels;

        return $taskId ? Task::findOrFail($taskId)->labels : Label::all();

    } 

}
