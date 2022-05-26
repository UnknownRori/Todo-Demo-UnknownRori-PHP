@extends('layouts.app')

@section('title', isset($todo) ? "Edit {$todo->get('id')}" : "Create Task")

@section('content')
    <div class="flex h-screen w-screen justify-center">
        <div class="w-96 items-center self-center bg-white p-4 shadow-xl ring-1 ring-gray-200">
            <h3 class="text-center text-3xl">{{ isset($todo) ? "Edit {$todo->get('id')}" : "Create Todo" }}</h3>
            <form action="{{ isset($todo) ? route('todo.update', ['id' => $todo->get('id')]) : route('todo.store') }}" method="post">
                {!! csrf() !!}

                <div class="flex flex-col self-stretch p-4">
                    <label for="name" class="text-gray-600 p-4">Todo</label>
                    <textarea name="todo" name="name" placeholder="Enter Task" class="p-2 border-2 border-slate-200 rounded bg-gray-100"cols="30" rows="10">{{ isset($todo) ? $todo->get('todo') : '' }}</textarea>
                </div>

                @if(isset($_GET['error']))
                    <div class="bg-red-400 rounded p-4 m-4">
                        <span class="text-white">
                            {{ $_GET['error'] }}
                        </span>
                    </div>
                @endif

                <div class="p-4 text-right">
                    <input type="submit" value="{{ isset($todo) ? "Edit" : "Create" }}"
                        class="rounded bg-sky-600 p-2 text-white ring-1 ring-sky-300 transition-colors duration-500 hover:bg-sky-500">
                </div>
            </form>
        </div>
    </div>
@endsection
