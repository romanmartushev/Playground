<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body>
    <div class="container box-shadow" id="root">
        <div class="row margin-top-lg">
            <div class="col-sm-12 text-center txt-white" style="background-color: #999999">
                <h1>@{{ welcome_message }}</h1>
            </div>
            <div class="col-sm-12" style="background-color: #5e5e5e;">
                <ul v-if="birthdays.length > 0" class="txt-white special-bullets mt-3">
                    <li v-for="person in birthdays" class="shadow">@{{person['name']}} turned @{{person['age']}} today!</li>
                </ul>
                <ul v-else class="txt-white special-bullets mt-3">
                    <li class="shadow">No Birthdays today!</li>
                </ul>
            </div>
        </div>
    </div>
    @include('partials/footer/familyTreeFooter')
    @include('partials/footer/additionalFooter')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="/js/axios.js"></script>
    <script src="/js/homepage.js"></script>
    </body>
</html>
