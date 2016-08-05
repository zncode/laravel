<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use App\Repositories\TaskRepository;



class TaskController extends Controller
{
    /**
     * 任务资源库的实例。
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 创建一个新的控制器实例。
     *
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
	 * 显示用户所有任务的清单。
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $tasks = Task::where('user_id', $request->user()->id)->get();

	    return view('tasks.index', [
	        'tasks' => $tasks,
	    ]);
	}

	/**
	 * 创建新的任务。
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $this->validate($request, [
	        'name' => 'required|max:255',
	    ]);

	    $request->user()->tasks()->create([
	        'name' => $request->name,
	    ]);

	    return redirect('/tasks');
	}

	/**
	 * 卸除指定的任务。
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function destroy(Request $request, Task $task)
	{
	  //  $this->authorize('destroy', $task);

    	$task->delete();

    	return redirect('/tasks');
    }
}
