@use(Core\Auth)
<nav class="bg-white bg-opacity-60 p-3">
    <div class="w-[90%] flex flex-row m-auto justify-between">
        <h2 class="text-3xl">Todo Lists</h2>
        <div class="flex flex-row">
            <p class="text-gray-600 mx-4">{{ Auth::user()->get('name') }}</p>
            <form action="{{ route('auth.logout') }}" method="post" class="mx-4">
                {!! csrf() !!}
                <input class="text-gray-600 cursor-pointer" type="submit" value="Logout">
            </form>
        </div>
    </div>
</nav>