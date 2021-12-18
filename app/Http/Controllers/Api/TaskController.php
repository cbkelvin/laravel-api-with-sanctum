<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
       //validation
       $request->validate([
        // "worker_id" => "required", 
        "name"=>"required", 
        "description"=>"required",
        "duration"=> "required"
       ]);
       //create data
       $student_id  = auth()->user()->id;

       $task = new Task();  
       $task->worker_id = $student_id;
       $task->name =  $request->name;
       $task->description = $request->description;
       $task->duration = $request->duration;
       $task->save();

       //send response
       return response()->json([
           "status"=> "1",
           "message" => "task created"
       ]);
    }
    public function listTask()
    {
        $worker_id = auth()->user()->id;

        $tasks  = Task::where("worker_id", $worker_id)->get();

        return response()->json([
            "status" => 1,
            "message" => "tasks",
            "data" => $tasks
        ]);

    }
    public function singleTask($id)
    {
        $worker_id = auth()->user()->id;

        if(Task::where(["id"=>$id, "worker_id" => $worker_id])->exists()){
           $task_details = Task::where(["id"=>$id , "worker_id" => $worker_id ])->first();
           return response()->json([
               "status" => 1,
               "message" => "task details",
               "data" => $task_details
           ]);
        }else{
            return reponse()->json([
                "status" => 0,
                "message" => "Task not found",
            ]);
        }

    }
    public function deleteTask($id)
    {
         $worker_id = auth()->user()->id;
          if(Task::where([ "id"=>$id , "worker_id" => $worker_id])->exists()){
              $task = Task::where(["id"=>$id, "worker_id"=>$worker_id])->first();
              $task->delete();
              return response()->json([
                  "status"=>1,
                  "message"=>"task deleted successfully"
              ]);
          }else{
              return response()->json([
                  "status" => 0,
                  "message" => "task not found"
              ]);
          }
    }
}
