<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class FamilyTree extends Controller
{
    /**
     * allows for the viewing of the family tree
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewTree(){
        $spouses = $this->Spouses();
        $families = $this->Children($spouses);
        for($i=0;$i<count($families);$i++){
            $sort_col = [];
            foreach ($families[$i] as $key=> $row){
                $sort_col[$key] = $row['age'];
            }
            array_multisort($sort_col, SORT_DESC, $families[$i]);
        }
        foreach ($families as $family){
            if(count($family) == 1){
                $index = array_search($family,$families);
                unset($families[$index]);
            }
        }
        $families = array_values($families);
        return view('mainFamilyTree')->with('families',$families);
    }

    /**
     * Foreach member find if they have a spouse
     * @return array
     */
    protected function Spouses(){
        $members = Member::all();
        $memToArray = $members->toArray();
        $sort_col = array();
        foreach ($members as $key=> $row) {
            $sort_col[$key] = $row['age'];
        }
        array_multisort($sort_col, SORT_DESC, $memToArray);
        $spouses = [];
        $i=0;
        foreach ($memToArray as $mem){
            if($mem['spouse'] != ""){
                foreach ($memToArray as $spouse){
                    if($spouse['spouse'] == $mem['id']){
                        array_push($spouses,[]);
                        array_push($spouses[$i],$mem);
                        array_push($spouses[$i],$spouse);
                        $i++;
                        $index = array_search($spouse,$memToArray);
                        unset($memToArray[$index]);
                    }
                }
            }else{
                array_push($spouses,[]);
                array_push($spouses[$i],$mem);
                $i++;
            }
            $index = array_search($mem,$memToArray);
            unset($memToArray[$index]);
        }
        return $spouses;
    }

    /**
     * Foreach couple find if they have children
     * @param $spouses
     * @return mixed
     */
    protected function Children($spouses){
        $i=0;
        $members = Member::all();
        $memToChildArray = $members->toArray();
        foreach($spouses as $couples){
            if($couples[0]['children'] !=""){
                $temp = trim($couples[0]['children']);
                $children = explode(" ",$temp);
                foreach ($children as $child){
                    foreach ($memToChildArray as $cMember){
                        if($cMember['id'] == $child){
                            array_push($spouses[$i],$cMember);
                        }
                    }
                }
            }
            $i++;
        }
        return $spouses;
    }

    /**
     * display the form for creating a new family member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function startCreate(){
        return view('addFamilyTree');
    }

    /**
     * used for returning the update page with all family members
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function startUpdate(){
        $members = Member::all();
        $members = $members->toArray();
        $sort_col = array();
        foreach ($members as $key=> $row) {
            $sort_col[$key] = $row['name'];
        }
        array_multisort($sort_col, SORT_ASC, $members);
        return view('updateFamilyTree')->with('members',$members);


    }

    /**
     * creates a new family member
     * @param Request $request
     * @return array
     */
    public function createMember(Request $request){
        if($request->input("name") != "" && $request->input("birthday") != ""){
            if($member = Member::where(['name' => $request->input("name"), 'birthday' => $request->input("birthday")])->first()){
                return $response = ['error' => 'Family Member Already Exists!'];
            }
            $date = new \DateTime($request->input("birthday"));
            $now = new \DateTime();
            $age = $now->diff($date);
            $member = new Member([
                "age" => $age->y,
                "name" => $request->input("name"),
                "birthday" => $request->input("birthday"),
                "phone_number" => $request->input("phoneNumber"),
                "email" => $request->input("email")
            ]);
            $member->save();
            return $response = ['success' =>'Family Member Successfully Added!'];
        }

        return $response = ['error' => 'Name and Birthday Fields must be Filled'];

    }

    /**
     * Updates a member
     * @param Request $request
     * @return array
     */
    public function updateMember(Request $request){
        $members = Member::all();
        $members = $members->toArray();
        $sort_col = array();
        foreach ($members as $key=> $row) {
            $sort_col[$key] = $row['name'];
        }
        array_multisort($sort_col, SORT_ASC, $members);

        $memberNameBirthDay = explode('Birthday:',$request->input("name"));
        $motherNameBirthDay = explode('Birthday:',$request->input("mother"));
        $fatherNameBirthDay = explode('Birthday:',$request->input("father"));
        $spouseNameBirthDay = explode('Birthday:',$request->input("spouse"));
        if($memberNameBirthDay[0] != "default"){
            $memberNameBirthDay[0] = trim($memberNameBirthDay[0]);
            $memberNameBirthDay[1] = trim($memberNameBirthDay[1]);
            $member = Member::where(['name' => $memberNameBirthDay[0], 'birthday' => $memberNameBirthDay[1]])->first();
            if($member){
                if($motherNameBirthDay[0] != "default"){
                    if($member->parents == "") {
                        $motherNameBirthDay[0] = trim($motherNameBirthDay[0]);
                        $motherNameBirthDay[1] = trim($motherNameBirthDay[1]);
                        $mother = Member::where(['name' => $motherNameBirthDay[0], 'birthday' => $motherNameBirthDay[1]])->first();

                        $mother->children = $mother->children . ' ' . $member->id;
                        $mother->save();
                    }else{
                        $parents = explode(" ",$member->parents);
                        $father = Member::where('id',$parents[0])->first();
                        $mother = Member::where('id',$parents[1])->first();
                        return $response = ['error' => 'Family Member Already Has Parents: '.$father->name.' And '.$mother->name];
                    }
                }
                if($fatherNameBirthDay[0] != "default"){
                    if($member->parents == "") {
                        $fatherNameBirthDay[0] = trim($fatherNameBirthDay[0]);
                        $fatherNameBirthDay[1] = trim($fatherNameBirthDay[1]);
                        $father = Member::where(['name' => $fatherNameBirthDay[0], 'birthday' => $fatherNameBirthDay[1]])->first();

                        $father->children = $father->children . ' ' . $member->id;
                        $father->save();
                    }else{
                        $parents = explode(" ",$member->parents);
                        $father = Member::where('id',$parents[0])->first();
                        $mother = Member::where('id',$parents[1])->first();
                        return $response = ['error' => 'Family Member Already Has Parents: '.$father->name.' And '.$mother->name];
                    }
                }
                if($spouseNameBirthDay[0] != "default"){
                    if($member->spouse == ""){
                        $spouseNameBirthDay[0] = trim($spouseNameBirthDay[0]);
                        $spouseNameBirthDay[1] = trim($spouseNameBirthDay[1]);
                        $spouse = Member::where(['name' => $spouseNameBirthDay[0], 'birthday' => $spouseNameBirthDay[1]])->first();
                        $spouse->spouse = $member->id;
                        $member->spouse = $spouse->id;
                        $spouse->save();
                        $member->save();
                    }
                    else{
                        $spouse = Member::where('id',$member->spouse)->first();
                        return $response = ['error'=>'Family Member Already Has A Spouse: '.$spouse->name.' '.$spouse->birthday];
                    }
                }
                if($request->input("phoneNumber") != ''){
                    $member->phone_number = $request->input("phoneNumber");
                    $member->save();
                }
                if($request->input("address") != ''){
                    $member->address = $request->input("address");
                    $member->save();
                }
                if($request->input("email") != ''){
                    $member->email = $request->input("email");
                    $member->save();
                }
                return $response = ['success' => 'Family Member Successfully Updated!'];
            }else{
                return $response = ['error' => 'A Family Member Must Be Entered!'];
            }
        }
        return $response = ['error' => 'A Family Member Must Be Entered!'];
    }

    /**
     * Checks to see if there is a birthday today
     * @return array
     */
    public function getBirthdays(){
        $members = Member::all();
        $birthdays =[];
        foreach ($members as $member){
            $check = substr($member->birthday,0, -5);
            $age = $this->getAge($member);
            $member->age = $age;
            $member->save();
            $month = date('m');
            $day = date('d');
            $now = $month."/".$day;
            if($now == $check){
                array_push($birthdays,$member->toArray());
            }
        }
        return $birthdays;
    }

    /**
     * Gets the age for a member
     * @param $member
     * @return int
     */
    public function getAge($member){
        $date = new \DateTime($member->birthday);
        $now = new \DateTime();
        $age = $now->diff($date);
        return $age->y;
    }
}
