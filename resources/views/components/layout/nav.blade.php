<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between" >
        <div >
           <a href="/">
               <img src="/images/logo.png" alt="logo" width="50">

           </a>
        </div>

        <div class="flex gap-x-6 items-center">
            @auth
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outlined">Log Out</button>
                </form>
            @else
                <a href="/login">Log In</a>
                <a href="/register" class="btn">Register</a>
            @endauth
        </div>

    </div>
</nav>
