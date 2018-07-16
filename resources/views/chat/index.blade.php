<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/chat.css" rel="stylesheet">
    <link href="/css/fontawesome/all.css" rel="stylesheet">
</head>
<body>
<div class="container margin-top-lg" id="root">
    <modal v-if="showModal" @close="showModal = false"></modal>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                </div>
                <div class="panel-collapse">
                    <div class="panel-body">
                        <ul class="chat" v-chat-scroll>
                            <li class="left clearfix padding-xs" v-for="message in chat">
                                <span class="chat-img pull-left">
                                    <img class="img-circle" :src=message.image />
                                </span>
                                <div class="chat-body clearfix" style="overflow-wrap: break-word;">
                                    <div class="header">
                                        <strong class="primary-font">@{{ message.user }}</strong><small class="pull-right text-muted">
                                            <span class="glyphicon glyphicon-time"></span>@{{ message.time }}</small>
                                    </div>
                                    <p>
                                        @{{ message.message }}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="text"/>
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat" @click="addMessage()">Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
@include('partials/footer/familyTreeFooter')
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/vue.js"></script>
<script src="/js/axios.js"></script>
<script src="/js/vue-chat-scroll.js"></script>
<script src="/js/chat/chat.js"></script>
</body>
</html>