<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class FamilyTree extends Controller
{
    public function startCreate()
    {
        return view('familyTree');
    }

    public function startUpdate()
    {
        $members = Member::all();
        $members = $members->toArray();
        $sort_col = array();
        foreach ($members as $key=> $row) {
            $sort_col[$key] = $row['name'];
        }
        array_multisort($sort_col, SORT_ASC, $members);
        return view('updateFamilyTree')->with('members',$members);


    }

    public function createMember(Request $request)
    {
        if($request->name != "" && $request->birthday != ""){
            if($member = Member::where(['name' => $request->name, 'birthday' => $request->birthday])->first()){
                return redirect('/add-member')->with('error','Family Member Already Exists!');
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
            return redirect('/add-member')->with('success','Family Member Successfully Added!');
        }

        return redirect('/add-member')->with('error','Name and Birthday Fields must be Filled');

    }
    public function updateMember(Request $request){
        $memberNameBirthDay = explode('Birthday:',$request->name);
        $motherNameBirthDay = explode('Birthday:',$request->mother);
        $fatherNameBirthDay = explode('Birthday:',$request->father);

        $memberNameBirthDay[0] = trim($memberNameBirthDay[0]);
        $memberNameBirthDay[1] = trim($memberNameBirthDay[1]);
        $member = Member::where(['name' => $memberNameBirthDay[0],'birthday' => $memberNameBirthDay[1]])->first();
        if($member){
            if($motherNameBirthDay[0] != "default"){
                $motherNameBirthDay[0] = trim($motherNameBirthDay[0]);
                $motherNameBirthDay[1] = trim($motherNameBirthDay[1]);
                $mother = Member::where(['name' => $motherNameBirthDay[0],'birthday' => $motherNameBirthDay[1]])->first();

                $mother->children = $mother->children .' '. $member->id;
                $mother->save();
            }

            if($fatherNameBirthDay[0] != "default") {
                $fatherNameBirthDay[0] = trim($fatherNameBirthDay[0]);
                $fatherNameBirthDay[1] = trim($fatherNameBirthDay[1]);
                $father = Member::where(['name' => $fatherNameBirthDay[0], 'birthday' => $fatherNameBirthDay[1]])->first();

                $father->children = $father->children . ' ' . $member->id;
                $father->save();
            }
            if($fatherNameBirthDay[0] != "default" && $motherNameBirthDay[0] != "default"){
                $member->parents = $father->id . ' ' . $mother->id;
                $member->save();
            }elseif($fatherNameBirthDay[0] != "default" && $motherNameBirthDay[0] == "default"){
                $member->parents = $father->id . ' ' . 0;
                $member->save();
            }elseif($fatherNameBirthDay[0] == "default" && $motherNameBirthDay[0] != "default"){
                $member->parents = 0 . ' ' . $mother->id;
                $member->save();
            }

            $members = Member::all();
            $members = $members->toArray();
            $sort_col = array();
            foreach ($members as $key=> $row) {
                $sort_col[$key] = $row['name'];
            }
            array_multisort($sort_col, SORT_ASC, $members);
            return view('updateFamilyTree')->with('members',$members)->with('success','Family Member Successfully Updated!');
        }else{
            $members = Member::all();
            $members = $members->toArray();
            $sort_col = array();
            foreach ($members as $key=> $row) {
                $sort_col[$key] = $row['name'];
            }
            array_multisort($sort_col, SORT_ASC, $members);
            return view('updateFamilyTree')->with('members',$members)->with('error','A Family Member Must Be Entered!');
        }

    }
}
