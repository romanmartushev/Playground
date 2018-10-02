<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add A Family Member</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row tree-1 padding-xs margin-top-lg">
            <div id="mainHeading" class="txt-white margin-left-auto margin-right-auto text-center">
                <h1 class="underline shadow">Add A Family Member</h1>
            </div>
            <div id="root" class="col-md-6">
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
                <button class="btn btn-default" v-on:click="addMember">Add Member</button>
                <div class="alert alert-success" v-if="success != ''">
                    <ul>
                        <li>@{{success}}</li>
                    </ul>
                </div>
                <div>
                    <div class="alert alert-danger" v-if="error != ''">
                        <ul>
                            <li>@{{error}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials/footer/familyTreeFooter')
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="/js/addMember.js"></script>
</body>
</html>