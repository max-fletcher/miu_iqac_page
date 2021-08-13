<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use App\Models\PeopleMember;
use Illuminate\Support\Str;
Use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;

class MemberController extends Controller
{

    public function index()
    {
        return response()->json(PeopleMember::with('people')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'people_id' => ['required', 'integer', 'numeric', 'exists:people,id'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'cell_number' => ['required', 'numeric', 'string'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'member_image' => [ 'image', 'sometimes', 'max:2000'],
            'resize_image' => ['required', 'numeric', 'integer'],
        ]);

        if($request->hasFile('member_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('member_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('member_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);

            // Make Folder if it doesn't exist
            $path = public_path('storage/member_images');
            if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
            }

            // Resize image if needed and store it in $image variable
            // Save image to designated folder inside storage
            if($request->resize_image == 1){
                // Aspect ratio of 0.56
                $image = Image::make($request->file('member_image'))->resize(620, 1250);
            }
            else{
                $image = Image::make($request->file('member_image'));
            }

            $image->save(public_path('storage/member_images/'. $filenameToStore));
        }
        else{
            $filenameToStore = 'noimage.png';
        }

        PeopleMember::Create([
            'people_id' => $request->people_id,
            'name' => $request->name,
            'designation' => $request->designation,
            'cell_number' => $request->cell_number,
            'email' => $request->email,
            'member_image' => $filenameToStore
        ]);

        //$request->file('member_image')->store('public/member_images');
        return response()->json('Member Created Successfully !', 201);
    }

    public function show($id)
    {
        $member = PeopleMember::with('people')->where('id', $id)->first();
        if($member){
            return response()->json($member, 200);
        }

        return response()->json('The Provided ID doesn\'t match any Member Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'people_id' => ['required', 'integer', 'numeric', 'exists:people,id'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'cell_number' => ['required', 'numeric', 'string'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'member_image' => [ 'image', 'sometimes', 'max:2000']
        ]);

        if($request->hasFile('member_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('member_image')->getClientOriginalName();
            //get just file name (using standard php function)
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('member_image')->getClientOriginalExtension();
            //filename to store(uses a time php function to get current time)
            //this string is a unique name so that file with duplicate name do not get uploaded and
            //cause problems when viewing(same problem that occured in CISV photo gallery)
            $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
            //upload image
            $request->file('member_image')->storeAs('public/member_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.png';
        }

        $member = PeopleMember::find($id);
        if ($member) {
            $member->people_id = $request->people_id;
            $member->name = $request->name;
            $member->designation = $request->designation;
            $member->cell_number = $request->cell_number;
            $member->email = $request->email;
            if($request->hasFile('member_image')){     //works if there is a new image uploaded
                Storage::delete('public/member_images/'.$member->member_image);  //deletes previous image
                //needs to use Illuminate\Support\Facades\Storage;
            }
            $member->member_image = $filenameToStore;
            $member->save();
            return response()->json('Member Updated Successfully !', 201);
        }

        return response()->json('The Provided ID doesn\'t match any Member Records !!', 404);
    }

    public function destroy($id)
    {
        $member = PeopleMember::find($id);
        if ($member) {            
            Storage::delete('public/member_images/'.$member->member_image);  //deletes iamge
            $member->delete();
            return response()->json('Member Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t delete because provided ID doesn\'t match any Member Records !!', 404);
    }

    public function find_all_members_by_people_id($id)
    {        
        $people = People::find($id);
        if ($people) {
            $members = PeopleMember::where('people_id', $id)->select('id', 'people_id', 'name', 'designation', 'cell_number', 'email', 'member_image')->with(['people' => function($query) {
                return $query->select(['id', 'name']);
            }])->get();
            return response()->json($members, 201);            
        }
        return response()->json('The Provided ID doesn\'t match any People Records !!', 404);
    }
}
