<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use DB;
use Auth;
use Storage;
use Carbon\Carbon;
use File;
class PhoneHomeController extends Controller
{
    public function login(Request $request)
    {
        $arr = [
            'username' => $request->username,
            'password' =>$request->password,
        ];
         //dd($arr);
         //dd(Auth::attempt($arr));
        if (Auth::attempt($arr)) {
            $id = $request->username;
            $puttype = DB::table('user')->where('username','=',$id)->select('type')->first();
          
            $type = $puttype->type;
            if($type == '0'){
                return response()->json(0, 201);
            }else if($type == '1'){
                return response()->json(1, 201);
            }
            //  
        }else{
            return response()->json(999, 201);
            // dd('thất bại');   
        }
    }
    public function updateImage(Request $request)
    {
        $username = $request->username;
        $image = $request->file('image');
        
        $googleDriveStorage=Storage::cloud();
        if(isset($image))
        {
            $path = public_path('File/File_img');
            $name = Str::Random(5).'_'.$image->getClientOriginalName(); 
            $fileData = File::get($image);

            $googleDriveStorage->put($name,  $fileData);
            $recursive = false;
            $dir = '/';
            $fileinfo = collect($googleDriveStorage->listContents($dir, $recursive))
            ->where('type', 'file')
            ->where('name', $name)
            ->first();
            $contents = $fileinfo['path'];
            $url = "https://drive.google.com/uc?export=view&id=".$contents;

        }else{
            $name = "";
        };
     





        if(DB::update('UPDATE `customer` , `user` SET `customer`.`avatar` = ? WHERE `customer`.`usernameId` = `user`.`id` AND `user`.`username` = ?',[$url,$username])){
            return response()->json(0, 200);
        }else{
            return response()->json(1, 200);
        }
    }
    public function updateBackground(Request $request)
    {
        $username = $request->username;
        $image = $request->file('image');
        
        $googleDriveStorage=Storage::cloud();
        if(isset($image))
        {
            $path = public_path('File/File_img');
            $name = Str::Random(5).'_'.$image->getClientOriginalName(); 
            $fileData = File::get($image);

            $googleDriveStorage->put($name,  $fileData);
            $recursive = false;
            $dir = '/';
            $fileinfo = collect($googleDriveStorage->listContents($dir, $recursive))
            ->where('type', 'file')
            ->where('name', $name)
            ->first();
            $contents = $fileinfo['path'];
            $url = "https://drive.google.com/uc?export=view&id=".$contents;

        }else{
            $name = "";
        };
        if(DB::update('UPDATE `customer` , `user` SET `customer`.`background` = ? WHERE `customer`.`usernameId` = `user`.`id` AND `user`.`username` = ?',[$url,$username])){
            return response()->json(0, 200);
        }else{
            return response()->json(1, 200);
        }
    }
    public function updateImageSer(Request $request)
    {
        $username = $request->username;
        $image = $request->file('image');
        
        $googleDriveStorage=Storage::cloud();
        if(isset($image))
        {
            $path = public_path('File/File_img');
            $name = Str::Random(5).'_'.$image->getClientOriginalName(); 
            $fileData = File::get($image);

            $googleDriveStorage->put($name,  $fileData);
            $recursive = false;
            $dir = '/';
            $fileinfo = collect($googleDriveStorage->listContents($dir, $recursive))
            ->where('type', 'file')
            ->where('name', $name)
            ->first();
            $contents = $fileinfo['path'];
            $url = "https://drive.google.com/uc?export=view&id=".$contents;

        }else{
            $name = "";
        };
     





        if(DB::update('UPDATE `service` , `user` SET `service`.`avatar` = ? WHERE `service`.`usernameId` = `user`.`id` AND `user`.`username` = ?',[$url,$username])){
            return response()->json(0, 200);
        }else{
            return response()->json(1, 200);
        }
    }
    public function updateBackgroundSer(Request $request)
    {
        $username = $request->username;
        $image = $request->file('image');
        
        $googleDriveStorage=Storage::cloud();
        if(isset($image))
        {
            $path = public_path('File/File_img');
            $name = Str::Random(5).'_'.$image->getClientOriginalName(); 
            $fileData = File::get($image);

            $googleDriveStorage->put($name,  $fileData);
            $recursive = false;
            $dir = '/';
            $fileinfo = collect($googleDriveStorage->listContents($dir, $recursive))
            ->where('type', 'file')
            ->where('name', $name)
            ->first();
            $contents = $fileinfo['path'];
            $url = "https://drive.google.com/uc?export=view&id=".$contents;

        }else{
            $name = "";
        };
        if(DB::update('UPDATE `service` , `user` SET `service`.`background` = ? WHERE `service`.`usernameId` = `user`.`id` AND `user`.`username` = ?',[$url,$username])){
            return response()->json(0, 200);
        }else{
            return response()->json(1, 200);
        }
    }
    public function retrieve(Request $request)
    {
        $username = $request->username;
        $data = DB::select('SELECT `customer`.`id`, `user`.`username`, `customer`.`fullname`, `customer`.`decription`, `customer`.`birthDay`, `customer`.`avatar`, `customer`.`background` FROM `customer`,`user` WHERE `user`.`id` = `customer`.`usernameId` AND `user`.`username` = ?',[$username]);
        return response()->json($data, 200);
    }
    public function phone(Request $request)
    {
        $phone = $request->phone;
    
        if( !$check = DB::table('user')
        ->select('id')
        ->where('username','=', $phone)
        ->first()){
            $pin = rand(1000, 9999);
            
            return response()->json($pin,
             201);
        }
        return response()->json('error',300);
 
       

    }
    public function getService(Request $request)
    {
        
        $ownerLongitude = $request->long;
        $ownerLatitude =  $request->lat;
        $distance = json_decode($request->range) / 1000.0;
        $type = json_decode($request->type);

        $raw = DB::raw(' ( 6371 * acos( cos( radians(' . $ownerLatitude . ') ) * 
        cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $ownerLongitude . ') ) + 
        sin( radians(' . $ownerLatitude . ') ) *
        sin( radians( latitude ) ) ) )  AS distance');
        if($type[0] == -1){
            $cares = DB::table('service')->select('*', $raw)
            ->addSelect($raw)
            ->orderBy('distance', 'ASC')
            ->having('distance', '<=', $distance)->get();
        }else if(in_array(0, $type)){
            $cares = DB::table('service')->select('*', $raw)
            ->addSelect($raw)->whereNotIn('type',[1,2,3,4,5,6,7,8,9])
            ->orderBy('distance', 'ASC')
            ->having('distance', '<=', $distance)->get();
        }
        else{
            $cares = DB::table('service')->select('*', $raw)
            ->addSelect($raw)->whereIn('type',$type)
            ->orderBy('distance', 'ASC')
            ->having('distance', '<=', $distance)->get();
        }
        return response()->json($cares,200);
    }

    public function getListPost(Request $request)
    {
        $username = $request->username;
        $posts = DB::select('SELECT `service`.`id`,`posts`.`id` as postId ,`user`.`username` ,`service`.`name`, `service`.`avatar`, `posts`.`title`, `posts`.`image`, `posts`.`date`  FROM `likes`, `posts`, `customer`, `user`,`service` WHERE `customer`.`usernameId` = `likes`.`usernameId` AND `service`.`usernameId` = `posts`.`usernameId` AND `service`.`usernameId` =  `user`.`id`   AND `service`.`usernameId` = ? GROUP BY `posts`.`id` ORDER BY `posts`.`id` DESC' ,[$username]);
        return response()->json($posts,200);
    }
    public function checklike(Request $request)
    {
        $username = $request->username;
        $postid = $request->postid;
        if($check = DB::select('SELECT * from `likes`, `user` WHERE  `likes`.`usernameId` = `user`.`id`and `user`.`username` = ? AND `likes`.`postId` = ?',[$username, $postid])){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
 
    }
    public function Uploadpost(Request $request)
    {
        $username = $request->username;
        $image = $request->file('image');
        $title = $request->title;
        $id = DB::table('user')
        ->select('id')
        ->where('username','=', $username)
        ->get()->pluck('id');
        // return response()->json($id,200);
        $googleDriveStorage=Storage::cloud();
        if(isset($image))
        {
            $path = public_path('File/File_img');
            $name = Str::Random(5).'_'.$image->getClientOriginalName(); 
            $fileData = File::get($image);

            $googleDriveStorage->put($name,  $fileData);
            $recursive = false;
            $dir = '/';
            $fileinfo = collect($googleDriveStorage->listContents($dir, $recursive))
            ->where('type', 'file')
            ->where('name', $name)
            ->first();
            $contents = $fileinfo['path'];
            $url = "https://drive.google.com/uc?export=view&id=".$contents;

        }else{
            $url = "";
        };
        if(DB::select('INSERT INTO `posts`(`usernameId`, `title`, `image`) VALUES (?,?,?)',[$id[0],$title,$url])){
            return response()->json($id, 200);
        }else{
            return response()->json(9999, 300);
        }
    }
    public function downloadJsonUserService(Request $request)
    {
        $username = $request->username;
        $data = DB::select('SELECT *  FROM `service`,`user` WHERE `user`.`id` = `service`.`usernameId` AND `user`.`username` = ?',[$username]);
        return response()->json($data, 200);
    }
    public function like(Request $request)
    {
        $username = $request->username;
        $postid = $request->postid;
        $id  = DB::table('user')->where('username','=',$username)->get()->pluck('id');
        if($check = DB::select('SELECT * from `likes`, `user` WHERE  `likes`.`usernameId` = `user`.`id`and `user`.`username` = ? AND `likes`.`postId` = ?',[$username, $postid])){
            DB::select('DELETE  from `likes` WHERE  `likes`.`usernameId` = ? AND `likes`.`postId` = ?',[$id[0], $postid]);
            return response()->json(0, 200);
            // return $id[0];
        }else{
            DB::select('INSERT INTO `likes` (`usernameId`, `postId`) VALUES (?,?)',[$id[0], $postid]);
            return response()->json(0, 200);
            // return $id[0];
        }
        
        
 
    }

    public function Register(Request $request)
    {
        $username =  $request->username;
        $password = bcrypt($request->password);
        $type = json_decode($request->type);
        try{
            DB::select('INSERT INTO `user` (`username`, `password`, `type`) VALUES (?,?,?)',[$username,$password,$type]);
            $id = DB::getPdo()->lastInsertId();
            $name = $request->name;
            $birth = $request->birth;
            Carbon::parse($birth)->format('d/m/Y');
            if($type == 0){
                DB::select('INSERT INTO `customer`(`usernameId`, `fullname`, `birthDay`) VALUES (?,?,?)',[$id,$name,$birth]);
            }else{
                $long = $request->long;
                $lat = $request->lat;
                $address = $request->address;
                $typeSv = $request->typeSv;
                DB::select('INSERT INTO `service`( `usernameId`, `name`, `birthDay`, `latitude`, `longitude`, `nameAddr`,`type`) VALUES (?,?,?,?,?,?,?)',[$id,$name,$birth,$lat,$long,$address,$typeSv]);
            }
            return response()->json(0, 200);
        }catch(ModelNotFoundException $exception){
            return response()->json(999, 999);
        }

    }
}
