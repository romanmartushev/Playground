<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class FamilyTree extends Controller
{
    public function createMember(Request $request)
    {
        if($request->name != "" && $request->birthday != ""){
            if($member = Member::where('name',$request->name)->first()){
                $date = new \DateTime($request->birthday);
                $now = new \DateTime();
                $age = $now->diff($date);
                $member->age = $age->y;
                $member->name = $request->name;
                $member->birthday = $request->birthday;
                $member->phone_number = $request->phoneNumber;
                $member->email = $request->email;
                $member->save();
                return redirect('/')->with('success','Family Member Was Updated!');
            }
            $member = new Member();
            $date = new \DateTime($request->birthday);
            $now = new \DateTime();
            $age = $now->diff($date);
            $member->age = $age->y;
            $member->name = $request->name;
            $member->birthday = $request->birthday;
            $member->phone_number = $request->phoneNumber;
            $member->email = $request->email;
            $member->save();
            return redirect('/')->with('success','Family Member Successfully Added!');
        }

        return redirect('/')->with('error','Name and Birthday Fields must be Filled');

    }
}
