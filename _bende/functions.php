<?php
	
	$ig_client_id = '7606640fcd3a445490dcec00e46f02f2';
	$ig_client_secret = 'fe2000a26de94844bda02c6c8d110717';
	
function stripUrl($link,$type){
	$replace = array('https://','http://','www.',
		$type.'.com',
		$type.'.net',
		$type.'.nl',
		$type.'.eu',
		'/');
		
	foreach($replace as &$replacer){
		$link = str_replace($replacer,'',$link);
	}
	$link = explode('?',$link);
	return $link[0]; 

}

function slugger($value,$type = NULL){
	if($type == NULL){
		$value = strtolower($value);
		$value = str_replace(' ','-',$value);
	} elseif($type == 'comma') {
		$value = strtolower($value);
		$value = str_replace(' ','',$value);
	}
	return $value; 
}

function ExistInDB($value,$table,$where){
	$qry = "SELECT * FROM ".$table." WHERE ".$where."='".$value."'";
	$results = mysql_query($qry);
	if(mysql_num_rows($results) > 0){ return true; } 
	else{ return false; }
}

function debug($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function insert($post,$value,$type){
	$slug = slugger($value);
	
	//debug($post);
	// create title
	if(!empty($post['title'])){ $title = $post['title']; }
	else{ $title = $slug; }
	
	// set category
	$category = explode(',',slugger($post['tag'],'comma'));
	$categories = [];
	foreach($category as $cat){
	echo ' <br />';
		if(ExistInDB($cat,'category','slug')){
			$categories[] = IDbySlug($cat,'category');
		} else { 
			insertCategory(slugger($cat),$cat);
			$categories[] = IDbySlug($cat,'category');
		}
	}
	//debug($categories);
	
	if($type == 1){
		$user_id = getIdByUser('instagram',$slug);
	} else {
		$user_id = '';
	}
	
	
	if(!ExistInDB($slug,'item','slug')){
		$timestamp = date('Y-m-d G:i:s');
		$query = "INSERT INTO item (slug,user_id,title,type,category,status,timestamp) VALUES ('".$slug."','".$user_id."','".$title."','".$type."','".json_encode($categories)."',1,'".$timestamp."')";
		if(mysql_query($query)){
				
				return $title.'('.$user_id.') is added'; 
		} else { return mysql_error() . $query; }
	} else {
		return 'Already exists';
	}
}

function getIdByUser($type,$username){
	if($type == 'instagram'){
		return getInstaID($username,$ig_client_id);
	}	
}

function getInstaID($username,$token){
    $username = strtolower($username); // sanitization
    $url = "https://api.instagram.com/v1/users/search?q=".$username."&client_id=7606640fcd3a445490dcec00e46f02f2";
    
    $get = file_get_contents($url);
    $json = json_decode($get);
    foreach($json->data as $user){
	    if($user->username == $username){
        return $user->id;
      }
    }
    return '00000000'; // return this if nothing is found
}


function insertCategory($slug,$title){
	$query = "INSERT INTO category (slug,title) VALUES ('".$slug."','".$title."')";
	if(mysql_query($query)){
		return true;
	} else {
		return false; 
	}
}
function convertToList($data,$type){
	$values = '';
	$i = 1;
	$total = count($data);
	if($type == 'comma'){
		if($i < $total){
			foreach($data as $value){
				if($i == $total){ $values .= SlugbyID($value,'category');
				} else { $values .= SlugbyID($value,'category').', '; }
				$i++;
			}
		}
	} elseif($type == 'hashtag'){
		if($i < $total){
			foreach($data as $value){
				$i++;
				if($i == $total){ $values .= '#'.SlugbyID($value,'category');
				} else { $values .= '#'.SlugbyID($value,'category').' '; }
			}
		}
	}
	return $values;
}

function IDbySlug($value,$table){
	return getValue($value,$table,'slug','ID');
}
function SlugbyID($value,$table){
	return getValue($value,$table,'ID','slug');
}
function TitlebyID($value,$table){
	return getValue($value,$table,'ID','title');
}
function getValue($value,$table,$from,$show){
	$query = "SELECT * FROM ".$table." WHERE ".$from."='".$value."'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {	
		return $row[$show];
	}
}
	
?>