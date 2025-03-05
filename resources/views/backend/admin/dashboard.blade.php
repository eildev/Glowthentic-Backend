<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World</h1>
    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <form method="POST" action="{{ url('/admin/logout') }}">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
