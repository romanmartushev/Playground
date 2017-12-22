<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Roman's PlayGround</title>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body>
    <div class="text-center txt-white gradient padding-xs">
        <h1>Welcome To My PlayGround!</h1>
        <div>Where Anything is Possible</div>
    </div>
    <h2>Family Tree Project</h2>
    <div class="col-md-6">
        <div>Add A Family Member</div>
        <form method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" class="form-control" name="name" id="InputName" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="InputBirthday">Birthday</label>
                <input type="text" class="form-control" name="birthday" id="InputBirthday" placeholder="Birthday">
            </div>
            <div class="form-group">
                <label for="InputPhoneNumber">Phone Number</label>
                <input type="text" class="form-control" name="phoneNumber" id="InputPhoneNumber" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" class="form-control" name="email" id="InputEmail" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-default">Add Member</button>
        </form>
        @if (session('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
