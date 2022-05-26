@extends('layouts.app')
@section('title', 'Todo List')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="m-auto mt-4 h-screen w-[90%] shadow">
        <div class="bg-white p-4 shadow-xl ring-1 ring-gray-500">
            <div class="m-4 p-2 text-right">
                <a href="{{ route('todo.create') }}" class="h-[50%] w-[50%] rounded-full bg-sky-500 p-4 text-white">Add Todo</a>
            </div>

            @if (isset($_GET['success']))
                <div class="m-4 rounded bg-green-500 p-4 text-white">
                    {{ $_GET['success'] }}
                </div>
            @endif
            @if (isset($_GET['err']))
                <div class="m-4 rounded bg-green-500 p-4 text-white">
                    {{ $_GET['err'] }}
                </div>
            @endif

            <table class="w-[100%]">
                <tr>
                    <td class="border-2 border-zinc-200 bg-zinc-300 p-4 text-center ring-1 ring-gray-200">ID</td>
                    <td class="border-2 border-zinc-200 bg-zinc-300 p-4 text-center ring-1 ring-gray-200">Todo</td>
                    <td class="border-2 border-zinc-200 bg-zinc-300 p-4 text-center ring-1 ring-gray-200">Complete</td>
                    <td class="w-[20%] border-2 border-zinc-200 bg-zinc-300 text-center ring-1 ring-gray-200">Action</td>
                </tr>
                @foreach ($todos->get() as $todo)
                    <tr>
                        <td class="border-zinc-200 bg-zinc-100 p-4 text-center ring-1 ring-gray-200">
                            {{ $todo['id'] }}
                        </td>
                        <td class="border-zinc-200 bg-zinc-100 p-4 ring-1 ring-gray-200">{{ $todo['todo'] }}</td>
                        <td class="border-zinc-200 bg-zinc-100 p-4 text-center ring-1 ring-gray-200">
                            {{ $todo['complete'] ? 'V' : 'X' }}</td>
                        <td class="border-zinc-200 bg-zinc-100 p-4 text-center ring-1 ring-gray-200">
                            <div class="flex flex-row text-white">
                                <form class="mx-2 rounded bg-sky-500 py-2 px-4 ring-1 ring-sky-300"
                                    action="{{ $todo['complete'] ? route('todo.incomplete') : route('todo.complete') }}"
                                    method="post">
                                    {!! csrf() !!}
                                    <input type="number" value="{{ $todo['id'] }}" name="id" hidden required>
                                    <input class="cursor-pointer" type="submit"
                                        value="{{ $todo['complete'] ? 'X' : 'V' }}">
                                </form>
                                <form class="mx-2 rounded bg-sky-500 py-2 px-4 ring-1 ring-sky-300"
                                    action="{{ route('todo.destroy') }}"
                                    method="post">
                                    {!! csrf() !!}
                                    <input type="number" value="{{ $todo['id'] }}" name="id" hidden required>
                                    <input class="cursor-pointer" type="submit"
                                        value="Delete">
                                </form>
                                <a class="mx-2 rounded bg-sky-500 py-2 px-4 ring-1 ring-sky-300"
                                    href="{{ route('todo.edit', ['todo' => $todo['id']]) }}">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
