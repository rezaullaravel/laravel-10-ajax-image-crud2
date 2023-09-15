<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

class MemberController extends Controller
{
    public function index(){
        $members = Member::all();
        return view('member.index',compact('members'));
    }//end method

    //store data
    public function store(Request $request)
    {


          if($request->file('photo')){
            $image=$request->file('photo');
            $imageName=rand().'.'.$image->getClientOriginalName();

              $image->move('upload/',$imageName);

              $imageUrl='upload/'.$imageName;
          }


        Member::insert([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'photo'=>$imageUrl,
        ]);
    }//end method


    //edit data
    public function edit($id){
        $member = Member::find($id);
        return response()->json([
           'member' => $member,
        ]);
    }//end method

    //update member data
    public function update(Request $request,$id){
        $member = Member::find($id);

        if($request->file('photo')){
            if(File::exists($member->photo)){
                unlink($member->photo);
            }

            $image=$request->file('photo');
            $imageName=rand().'.'.$image->getClientOriginalName();

              $image->move('upload/',$imageName);

              $imageUrl='upload/'.$imageName;

               $member->photo = $imageUrl;
          }

          $member->name = $request->name;
          $member->phone = $request->phone;
          $member->save();
    }//end method
}
