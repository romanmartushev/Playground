<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dark</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/dark.css" rel="stylesheet">
</head>
<body class="body-dark">
<div class="container" id="root">
    <div class="row margin-top-lg">
        <div class="col-sm-12 text-center display-1">
            <span v-for="item in header.message" @mouseover="changeColor(item)" :class="{white: item.isActive}">@{{ item.message }}</span>
        </div>
        <div class="col-sm-12 text-center display-4">
            <span v-for="item in body.message" @mouseover="changeColor(item)" :class="{white: item.isActive}">@{{ item.message }}</span>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="/js/axios.js"></script>
<script src="/js/dark.js"></script>
</body>
</html>
