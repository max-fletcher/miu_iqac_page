<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use App\Models\PeopleMember;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
Use Illuminate\Support\Facades\File;
use App\Rules\noimage;

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
        ]);

        if($request->hasFile('member_image')) {

            $request->validate([
                'member_image' => ['required', 'image', 'max:2000', new noimage],
                'resize_image' => ['required', 'numeric', 'integer'],
            ]);

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
            $filenameToStore = 'noimage.jpg';
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

        return response()->json('The Provided ID Doesn\'t Match Any Member Records !!', 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'people_id' => ['required', 'integer', 'numeric', 'exists:people,id'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'cell_number' => ['required', 'numeric', 'string'],
            'email' => ['required', 'email', 'string', 'max:255'],
        ]);

        $member = PeopleMember::find($id);
        if ($member) {

            if($request->hasFile('member_image')) {

                $request->validate([
                    'member_image' => ['required', 'image', 'max:2000', new noimage],
                    'resize_image' => ['required', 'numeric', 'integer'],
                ]);

                  //deletes previous image
                if($member->member_image != "noimage.jpg")
                    File::delete(public_path('storage/member_images/'.$member->member_image));
                // Storage::delete('public/member_images/'.$member->member_image);

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
                
                //upload image
                // $request->file('member_image')->storeAs('public/member_images', $filenameToStore);
            }
            else{
                $filenameToStore = 'noimage.jpg';
            }

            $member->people_id = $request->people_id;
            $member->name = $request->name;
            $member->designation = $request->designation;
            $member->cell_number = $request->cell_number;
            $member->email = $request->email;
            $member->member_image = $filenameToStore;
            $member->save();
            return response()->json('Member Updated Successfully !', 201);
        }

        return response()->json('The Provided ID Doesn\'t Match Any Member Records !!', 404);
    }

    public function destroy($id)
    {
        $member = PeopleMember::find($id);
        if ($member) {
            // using this instead of Storage::delete since in create method, intervention image doesn't work with
            // storeAs method (uses GD library) so used File facade there as well as here to maintain consistency
            // Storage::delete('public/member_images/'.$member->member_image);  //deletes iamge
            if($member->member_image != "noimage.jpg")
                File::delete(public_path('storage/member_images/'.$member->member_image));
            $member->delete();
            return response()->json('Member Data Destroyed Successfully !', 201);
        }

        return response()->json('Can\'t Delete Because Provided ID Doesn\'t Match Any Member Records !!', 404);
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
        return response()->json('The Provided ID Doesn\'t Match Any People Records !!', 404);
    }
}
