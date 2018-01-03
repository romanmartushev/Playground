@extends('updateFamilyTreeLayout')

@section('Members')
    @if(count($members) != 0)
        <label class="txt-white" for="familyMemberSelector">Select A Family Member:</label>
        <br>
        <select id="familyMemberSelector" name="name">
        <option value="default">Family Member</option>
        @for($i=0; $i < count($members); $i++)
            <option>{{$members[$i]['name']}} Birthday: {{$members[$i]['birthday']}}</option>
        @endfor
        </select>
        <br>
        <label class="txt-white" for="Mother">Select Family Member's Mother:</label>
        <br>
        <select id="Mother" name="mother">
            <option value="default">Mother</option>
            @for($i=0; $i < count($members); $i++)
                <option>{{$members[$i]['name']}} Birthday: {{$members[$i]['birthday']}}</option>
            @endfor
        </select>
        <br>
        <label class="txt-white" for="Father">Select Family Member's Father:</label>
        <br>
        <select id="Father" name="father">
            <option value="default">Father</option>
            @for($i=0; $i < count($members); $i++)
                <option>{{$members[$i]['name']}} Birthday: {{$members[$i]['birthday']}}</option>
            @endfor
        </select>
        <br>
        <label class="txt-white" for="Spouse">Select Family Member's Spouse:</label>
        <br>
        <select id="Spouse" name="spouse">
            <option value="default">Spouse</option>
            @for($i=0; $i < count($members); $i++)
                <option>{{$members[$i]['name']}} Birthday: {{$members[$i]['birthday']}}</option>
            @endfor
        </select>
    @else
    <h1>Sorry No Family Members Exist</h1>
    @endif
@stop