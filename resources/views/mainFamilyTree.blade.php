@extends('mainFamilyTreeLayout')

@section('Members')
    @if(count($families) != 0)
        <ul class="nav nav-pills">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Select A Family<span class="caret"></span></a>
                <ul class="dropdown-menu">
            @if($families[0][0]['spouse'] != "")
            <li><a data-toggle="tab" href="#f0">{{$families[0][0]['name']}} & {{$families[0][1]['name']}}</a></li>
            @else
                <li><a data-toggle="tab" href="#f0">{{$families[0][0]['name']}}</a></li>
            @endif
            @for($i=1;$i<count($families);$i++)
                @if($families[$i][0]['spouse'] != "")
                    <li><a data-toggle="tab" href="#f{{$i}}">{{$families[$i][0]['name']}} & {{$families[$i][1]['name']}}</a> </li>
                @else
                    <li><a data-toggle="tab" href="#f{{$i}}">{{$families[$i][0]['name']}}</a></li>
                @endif
            @endfor
                </ul>
        </ul>
        <div class="tab-content">
            <div id="f0" class="tab-pane fade in active">
                @if($families[0][0]['spouse'] != "")
                    <div class="row text-center txt-white">
                        @if(count($families[0]) > 2)
                            <h2>Parents:</h2>
                        @elseif(count($families[0]) == 2)
                            <h2>Couple:</h2>
                        @endif
                        <div class="col-md-4 col-md-offset-2 leaf">
                            <ul class="no-bullets">
                                Name:
                                <li>{{$families[0][0]['name']}}</li>
                                Birthday:
                                <li>{{$families[0][0]['birthday']}}</li>
                            </ul>
                        </div>
                        <div class="col-md-4 leaf">
                            <ul class="no-bullets">
                                Name:
                                <li>{{$families[0][1]['name']}}</li>
                                Birthday:
                                <li>{{$families[0][1]['birthday']}}</li>
                            </ul>
                        </div>
                    </div>
                    @if(count($families[0]) > 2)
                        <div class="row text-center txt-white">
                            <h3>Children:</h3>
                            @for($i=2; $i<count($families[0]);$i++)
                                <div class="col-md-4 leaf">
                                    <ul class="no-bullets">
                                        Name:
                                        <li>{{$families[0][$i]['name']}}</li>
                                        Birthday:
                                        <li>{{$families[0][$i]['birthday']}}</li>
                                    </ul>
                                </div>
                            @endfor
                        </div>
                    @endif
                @else
                    <div class="row text-center txt-white">
                        @if(count($families[0]) > 1)
                            <h2>Parent:</h2>
                        @endif
                        <div class="col-md-4 col-md-offset-4 leaf">
                            <ul class="no-bullets">
                                Name:
                                <li>{{$families[0][$i]['name']}}</li>
                                Birthday:
                                <li>{{$families[0][$i]['birthday']}}</li>
                            </ul>
                        </div>
                    </div>
                    @if(count($families[0]) > 1)
                        <div class="row text-center txt-white">
                            <h3>Children:</h3>
                            @for($i=1; $i<count($families[0]);$i++)
                                <div class="col-md-4 leaf">
                                    <ul class="no-bullets">
                                        Name:
                                        <li>{{$families[0][$i]['name']}}</li>
                                        Birthday:
                                        <li>{{$families[0][$i]['birthday']}}</li>
                                    </ul>
                                </div>
                            @endfor
                        </div>
                    @endif
                @endif
            </div>
            @for($i=1;$i<count($families);$i++)
                <div id="f{{$i}}" class="tab-pane fade">
                    @if($families[$i][0]['spouse'] != "")
                        <div class="row text-center txt-white">
                            @if(count($families[$i]) > 2)
                                <h2>Parents:</h2>
                            @elseif(count($families[$i]) == 2)
                                <h2>Couple:</h2>
                            @endif
                            <div class="col-md-4 leaf col-md-offset-2">
                                <ul class="no-bullets">
                                    Name:
                                    <li>{{$families[$i][0]['name']}}</li>
                                    Birthday:
                                    <li>{{$families[$i][0]['birthday']}}</li>
                                </ul>
                            </div>
                            <div class="col-md-4 leaf">
                                <ul class="no-bullets">
                                    Name:
                                    <li>{{$families[$i][1]['name']}}</li>
                                    Birthday:
                                    <li>{{$families[$i][1]['birthday']}}</li>
                                </ul>
                            </div>
                        </div>
                        @if(count($families[$i]) > 2)
                            <div class="row text-center txt-white">
                                <h3>Children:</h3>
                                @for($j=2; $j<count($families[$i]);$j++)
                                    <div class="col-md-4 leaf">
                                        <ul class="no-bullets">
                                            Name:
                                            <li>{{$families[$i][$j]['name']}}</li>
                                            Birthday:
                                            <li>{{$families[$i][$j]['birthday']}}</li>
                                        </ul>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    @else
                        <div class="row text-center txt-white">
                            @if(count($families[$i]) > 1)
                                <h2>Parent:</h2>
                            @endif
                            <div class="col-md-4 leaf col-md-offset-4">
                                <ul class="no-bullets">
                                    Name:
                                    <li>{{$families[$i][0]['name']}}</li>
                                    Birthday:
                                    <li>{{$families[$i][0]['birthday']}}</li>
                                </ul>
                            </div>
                        </div>
                        @if(count($families[$i]) > 1)
                            <div class="row text-center txt-white">
                                <h3>Children:</h3>
                                @for($j=1; $j<count($families[$i]);$j++)
                                    <div class="col-md-4 leaf">
                                        <ul class="no-bullets">
                                            Name:
                                            <li>{{$families[$i][$j]['name']}}</li>
                                            Birthday:
                                            <li>{{$families[$i][$j]['birthday']}}</li>
                                        </ul>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    @endif
                </div>
            @endfor
        </div>
    @endif
@stop