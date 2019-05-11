<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{
     protected $table = 'blogs';


     public function getAllBlogs($request)
    {

    	$where = "blogs.id>0";

    	if(isset($request->searchtext)){
    		$searchtext = $request->searchtext;
    		$where = "(title like '%$searchtext%' or description like '%$searchtext%' or users.name like '%$searchtext%') and deleted_status=0";
    	}

		$blogData = Blog::where('blogs.deleted_status', 0)
					->select('blogs.*','users.name')
                    ->orderBy('blogs.id', 'desc')
                    ->join('users', 'users.id', '=', 'blogs.user_id')
                    ->whereRaw($where)
                    ->paginate(5);

			return $blogData;
		
    }

	public function insertData($data){
		$id = DB::table('blogs')->insertGetId($data);
		
		return $id;
	}

	public function getBlogById($id){

		return Blog::where('blogs.id', $id)
		->select('blogs.*','users.name')
		->join('users', 'users.id', '=', 'blogs.user_id')
		->first();
	}

	public function updateData($data,$id){
		DB::table('blogs')->where('id',$id)->update($data);
	}

	public function deleteBlog($data,$id){
		DB::table('blogs')->where('id',$id)->update($data);
	}

}
