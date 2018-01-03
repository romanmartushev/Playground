@extends('mainFamilyTreeLayout')

@section('Members')
    @if(count($families) != 0)
        @foreach($families as $couple)
            @if($couple[0]['spouse'] != "")
                <div class="text-center">
                    @if(count($couple) > 2)
                        <h2>Parents:</h2>
                    @elseif(count($couple) == 2)
                        <h2>Couple:</h2>
                    @endif
                    <div class="circle border rounded inline-block">
                        <div class="center-block">
                            <ul class="no-bullets circle-margin">
                                Name:
                                <li>{{$couple[0]['name']}}</li>
                                Birthday:
                                <li>{{$couple[0]['birthday']}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="circle border rounded inline-block">
                        <div class="center-block">
                            <ul class="no-bullets circle-margin">
                                Name:
                                <li>{{$couple[1]['name']}}</li>
                                Birthday:
                                <li>{{$couple[1]['birthday']}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if(count($couple) > 2)
                    <div class="text-center">
                        <h3>Children:</h3>
                    @for($i=2; $i<count($couple);$i++)
                        <div class="circle border rounded inline-block">
                            <div class="center-block">
                                <ul class="no-bullets circle-margin">
                                    Name:
                                    <li>{{$couple[$i]['name']}}</li>
                                    Birthday:
                                    <li>{{$couple[$i]['birthday']}}</li>
                                </ul>
                            </div>
                        </div>
                    @endfor
                    </div>
                @endif
            @else
                <div class="text-center">
                        @if(count($couple) > 1)
                            <h2>Parent:</h2>
                        @endif
                            <div class="circle border rounded inline-block">
                                <div class="center-block">
                                    <ul class="no-bullets circle-margin">
                                        Name:
                                        <li>{{$couple[0]['name']}}</li>
                                        Birthday:
                                        <li>{{$couple[0]['birthday']}}</li>
                                    </ul>
                                </div>
                            </div>
                </div>
                @if(count($couple) > 1)
                    <div class="text-center">
                        <h3>Children:</h3>
                    @for($i=1; $i<count($couple);$i++)
                        <div class="circle border rounded inline-block">
                            <div class="center-block">
                                <ul class="no-bullets circle-margin">
                                    Name:
                                    <li>{{$couple[$i]['name']}}</li>
                                    Birthday:
                                    <li>{{$couple[$i]['birthday']}}</li>
                                </ul>
                            </div>
                        </div>
                    @endfor
                    </div>
                @endif
            @endif
        @endforeach
    @endif
@stop