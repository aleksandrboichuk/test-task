<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="/home">
                Admin Panel
            </a>
        </li>
        <li>
            <a href="/user">Users</a>
        </li>
        <li>
            <a href="/post">Posts</a>
        </li>
        <li class="mt-3">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-info">Logout</button>
            </form>
        </li>
    </ul>
</div>
