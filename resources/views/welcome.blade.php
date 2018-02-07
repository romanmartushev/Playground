<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body>
    <div class="container box-shadow" id="root">
        <div class="row margin-top-lg relative">
            <div id="mainHeading" class="txt-white absolute margin-left-auto margin-right-auto text-center">
                <h1 class="underline shadow">The Family Tree Project</h1>
            </div>
            <img id="treeImg" class="img-responsive" src="/Images/tree-with-roots.jpg">
            <div class="absolute" v-if="response !==''" style="bottom:0;">
                <ul class="txt-white special-bullets">
                    <li v-for="member in response" class="shadow">@{{member['name']}} turned @{{member['age']}} today!</li>
                </ul>
            </div>
        </div>
    </div>
    @include('partials/footer/familyTreeFooter')
    @include('partials/footer/additionalFooter')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="/js/homepage.js"></script>
    </body>
</html>
