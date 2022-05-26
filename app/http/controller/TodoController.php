<?php

namespace App\Http\Controller;

use App\Models\Todo;
use Core\Auth;
use Core\Http\Request;

class TodoController
{
    public function index(){
        return view('todo.index', [
            'todos' => Todo::where('user_id', Auth::user()->get('id'))
        ]);
    }

    public function create(){
        return view('todo.form');
    }

    public function store(){
        $validated = Request::validate([
            'todo' => ['string'],
        ]);

        $validated['complete'] = 0;
        $validated['user_id'] = Auth::user()->get('id');

        if (Todo::create($validated)) return redirect('todo.index', ['success' => 'Task successfully changed!']);
        return redirect('todo.index', ['err' => 'Task successfully changed']);
    }

    public function edit(){
        $validated = Request::validate(['todo' => ['numeric']]);
        return view('todo.form', [
            'todo' => Todo::find($validated['todo'])
        ]);
    }

    public function update(){
        $validated = Request::validate([
            'id' => ['numeric'],
            'todo' => ['string'],
        ]);

        $todo = Todo::find($validated['id']);
        $todo->fill($validated);
        if ($todo->save()) return redirect('todo.index', ['success' => 'Task successfully changed!']);
        return redirect('todo.index', ['err' => 'Task successfully changed']);
    }

    public function destroy(){
        $validated = Request::validate(['id' => ['numeric']]);
        if(Todo::destroy($validated['id'])) return redirect('todo.index', ['success' => 'Task successfully changed!']);
        return redirect('todo.index', ['err' => 'Task successfully changed']);
    }

    public function complete()
    {
        $validated = Request::validate(['id' => ['numeric']]);
        $todo = Todo::find($validated['id']);
        $todo->fill(['complete' => 1]);
        if($todo->save()) return redirect('todo.index', ['success' => 'Task successfully changed!']);
        return redirect('todo.index', ['err' => 'Task successfully changed']);
    }

    public function incomplete()
    {
        $validated = Request::validate(['id' => ['numeric']]);
        $todo = Todo::find($validated['id']);
        $todo->fill(['complete' => 0]);
        if ($todo->save()) return redirect('todo.index', ['success' => 'Task successfully changed']);
        return redirect('todo.index', ['err' => 'Task successfully changed']);
    }
}
