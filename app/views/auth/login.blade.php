@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex h-screen w-screen justify-center">
        <div class="w-96 items-center self-center bg-white p-4 shadow-xl ring-1 ring-gray-200">
            <h3 class="text-center text-3xl">Login</h3>
            <form action="{{ route('auth.auth') }}" method="post">
                {!! csrf() !!}

                <div class="flex flex-col self-stretch p-4">
                    <label for="name" class="text-gray-600 p-4">Name</label>
                    <input type="text" name="name" placeholder="Enter Username" class="p-2 border-2 border-slate-200 rounded bg-gray-100" required>
                </div>

                <div class="flex flex-col self-stretch p-4">
                    <label for="password" class="text-gray-600 p-2">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" class="p-2 border-2 border-slate-200 rounded bg-gray-100" required>
                </div>

                @if(isset($_GET['error']))
                    <div class="bg-red-400 rounded p-4 m-4">
                        <span class="text-white">
                            {{ $_GET['error'] }}
                        </span>
                    </div>
                @endif

                <div class="p-4 text-right">
                    <a href="{{ route('auth.create') }}" class="hover:underline hover:text-sky-700 text-sky-500">Don't have account?</a>
                    <input type="submit" value="Login"
                        class="rounded bg-sky-600 p-2 text-white ring-1 ring-sky-300 transition-colors duration-500 hover:bg-sky-500">
                </div>
            </form>
        </div>
    </div>
@endsection
