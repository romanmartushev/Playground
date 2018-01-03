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
    <h2 class="text-center txt-white gradient padding-xs">Add Family Member</h2>
    <div class="row tree-1 padding-xs margin-left-auto margin-right-auto">
        <div class="col-md-6">
            <form method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="txt-white" for="InputName">Name:</label>
                    <input type="text" class="form-control" name="name" id="InputName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label class="txt-white" for="InputBirthday">Birthday:</label>
                    <input type="text" class="form-control" name="birthday" id="InputBirthday" placeholder="Birthday">
                </div>
                <div class="form-group">
                    <label class="txt-white" for="InputPhoneNumber">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" id="InputPhoneNumber" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label class="txt-white" for="InputEmail">Email address:</label>
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
    </div>
    @include('partials/footer/familyTreeFooter')
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>