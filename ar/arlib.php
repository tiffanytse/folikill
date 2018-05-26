<?

	createVariablePost("action");
	
	createVariablePost("src_image");
	createVariablePost("max_width");
	createVariablePost("max_height");	
	createVariablePost("extra_div");	
	createVariablePost("extra_img");	


	
if($action=="fit_image")
{
	if($src_image)
		$style_img= fit_image($src_image, $max_width, $max_height);
	else return "error";
	
?>	
	
		<img src="<?echo $src_image;?>" alt="" style="<?echo $style_img;?>;margin:5px;"/>
	
	
<?
}
if($action=="image2div")
{
	if($src_image)
	{
		list($style_div,$style_img) = image2div($src_image, $max_width,$max_height);
		echo "$style_div||||$style_img";
	}
	else return "error";
		
	
}


/****************************************************
*
ARphpLib.php
*
****************************************************/


////////////////////////////////////////////////////////////////////////////////////
function createVariablePost($var_name, $special=0)
{
	global ${$var_name};
	if (isset($_POST[$var_name])) ${$var_name} = $_POST[$var_name];
	else if (isset($_GET[$var_name])) ${$var_name}=$_GET[$var_name];
	if ($special == 1) ${$var_name} = str_replace("'","&#39;",${$var_name});
	return ${$var_name};
//if ($special == 1) ${$var_name} = htmlspecialchars(${$var_name}, ENT_QUOTES);
}

function uploadFileto($file,$dir)
{
	$tmp_name = $_FILES[$file]["tmp_name"];
    $name = $_FILES[$file]["name"];
    move_uploaded_file($tmp_name, "$dir/$name");
}
////////////////////////////////////////////////////////////////////////////////////




/****************************** TEXT ******************************
	LINK - TEXT - STRING 

*********************************************************************/
//// MINUSCULAS A MAYUSCULAS CON ACCENTOS
//// USO: print fullUpper($texto)

function cut($string, $width, $padding = "...") { 
// Corta un string [$string] y despues del caracter [$width] anhade "..." por defecto o lo que se le diga si se define
    return (strlen($string) > $width ? substr($string, 0, $width-strlen($padding)).$padding : $string); 
}
function fullUpper($str){
   // convert to entities
   $subject = htmlentities($str,ENT_QUOTES);
   $pattern = '/&([a-z])(uml|acute|circ';
   $pattern.= '|tilde|ring|elig|grave|slash|horn|cedil|th);/e';
   $replace = "'&'.strtoupper('\\1').'\\2'.';'";
   $result = preg_replace($pattern, $replace, $subject);
   // convert from entities back to characters
   $htmltable = get_html_translation_table(HTML_ENTITIES);
   foreach($htmltable as $key => $value) {
      $result = ereg_replace(addslashes($value),$key,$result);
   }
   return(strtoupper($result));
}

function convertLink($text,$label,$target="_blank")
{
		
	if ($label!="")
	{
	  $text=preg_replace(',(?<!=")(?:https|http|ftp|file)://(?>[^<>[:space:]]+[[:alnum:]/])(?!</a),i','<a href="\0" target='.$target.'>'.$label.'</a>',$text);
	  $text = preg_replace(',(?<!//)www\.(?>[^<>[:space:]]+[[:alnum:]/])(?!</a),i','<a href="http://\0" target='.$target.'>'.$label.'</a>',$text);
	}

	else
	{
	 
	  $text=preg_replace(',(?<!=")(?:https|http|ftp|file)://(?>[^<>[:space:]]+[[:alnum:]/])(?!</a),i','<a href="\0" target='.$target.'>\0</a>',$text);
	  $text = preg_replace(',(?<!//)www\.(?>[^<>[:space:]]+[[:alnum:]/])(?!</a),i','<a href="http://\0" target='.$target.'>\0</a>',$text);
	}
    return $text;
}

function text2link($text, $label="")
{
	$text=str_replace("\n"," ",$text);
	$strexp=explode(" ",$text);
	for ($a=0;$a<count($strexp);$a++)
	{
		if (strcmp(substr($strexp[$a],0,22),"http://www.youtube.com")==0)
		{
			if (strcmp(substr($strexp[$a],0,27),"http://www.youtube.com/user")==0) $strexp[$a] = youtubeid_embed(substr($strexp[$a],-11),320,205);
			else $strexp[$a]=youtubeid_embed($strexp[$a],320,205);
		}

		else $strexp[$a]=convertLink($strexp[$a],$label);
	}
	return implode(" ",str_replace("<br<","<",$strexp));
}

function labellink($link)
{
	$link = str_replace("http://","",$link);
	$link = str_replace("https://","",$link);
	$link = preg_replace('#^(.*?)[\/]+(.*?)$#','$1',$link);
	return $link;
}
function javaquotes($content )
{
	$content = str_replace("'", '\x27', $content);
	$content = str_replace("\"", '\x22', $content);
	return $content;
	
}

function text2blocks($content, $maxlines)
{
	$contentbio = array();
	$pages= array();
	$page= array();
	//echo $content;
	//$content = nl2br($content);
	//$content = str_replace(" /\r/\n", "<br>" ,$content);
	
	$contentbio = explode("<br />",$content);
	//echo nl2br($content);	
	//echo count($contentbio);
	$n=0;
	$j=0;
	$pages[$n] ="";
	for($i=0;$i<count($contentbio);$i++)
	{	//echo count($contentbio);
		
		if($j<$maxlines)
		{	
			$pages[$n] .=$contentbio[$i]."<br />";
				//echo "+++++++++++++++"; 
		}
		else
		{
			$j=0;
			$n++;
			$pages[$n] =$contentbio[$i]."<br />";
			//echo "===================="; 
		}
		$j++;
	}	//echo "<br>====================<br>"; 
	return $pages;
	$page[0]= $content;
	//return $page;
}



/****************************** VIDEO ******************************

VIDEO - YOUTUBE - VIMEO - 

*********************************************************************/
function youtubeId($url)
{
	if (preg_match('%youtube\\.com/(.+)%', $url, $match))
	{
		$match = $match[1];
		$replace = array("watch?v=", "v/", "vi/");
		$match = str_replace($replace, "", $match);
		$match = str_replace("<br","",$match);
	}
	else $match = $url;

	return substr($match,0,11);
}
function youtubeid_embed($url,$width,$height)
{
		$match=youtubeId($url);
		$vid = '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$match.'?fs=1&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$match.'?fs=1&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed></object>';
		return $vid;
		
}



/****************************** IMAGE ******************************

	RESIZE - CROP - FIT TO SQUARE

*********************************************************************/

function imageresize($imagen,$ancho,$alto,$force=0)
// Cambia el tamanho de una imagen ajustandola al maximo [$ancho] o [$alto] deseados
// force=1 -> force exact dimensions
{
	if ((substr($imagen, -3)=='gif') || (substr($imagen, -3)=='GIF')) $src = imagecreatefromgif($imagen);
	else if ((substr($imagen, -3)=='png') || (substr($imagen, -3)=='PNG')) $src = imagecreatefrompng($imagen);
	else $src = imagecreatefromjpeg($imagen);

	list($width,$height)=getimagesize($imagen);
	if ($ancho>$width && $alto>$height)
	{
		$newwidth=$width;
		$newheight=$height;
	}
	else
	{
		if ($width>$height)
		{
			$newwidth=$ancho;
			$newheight=($height/$width)*$ancho;
		}
		else
		{
			$newheight=$alto;
			$newwidth=($width/$height)*$alto;
		}
	}

	if ($force==1)
	{
		if ($width>$height)
		{
			$newwidth=$ancho;
			$newheight=($height/$width)*$ancho;
		}
		else
		{
			$newheight=$alto;
			$newwidth=($width/$height)*$alto;
		}
	}

	$newwidth = intval($newwidth);
	$newwidth = intval($newwidth);
	$width= intval($width);
	$height= intval($height);
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $imagen;
	imagejpeg($tmp,$filename,100);
	imagedestroy($src);
	imagedestroy($tmp);
}


function fit_image($src_image, $max_width= 90,$max_height= 90)
{
			
	list($width,$height)= getimagesize($src_image);
			
		$rel = ($width/ $max_width);
		$h_result = $height/$rel;
			
	
	if(($width>$height && $h_result<$max_height) || ($width<$height && $h_result<$max_height))
	{	
		$rel = ($width/ $max_width);
		$w_result =	$max_width;							
		$h_result = $height/$rel;		
		
	}	
	else
	{	
		$rel = ($height/ $max_height);	
		$h_result = $max_height;
		$w_result = $width/$rel;	
		
		
	}

	
	$style_img= "max-width:".$w_result."px !important;";
		$style_img.= "max-height:".$h_result."px !important;";		
		$style_img.= "height:".$h_result."px;width:".$w_result."px;rel:".$rel.";height_:".$height.";width_:".$width.";";
		
	return $style_img;
}
/*
	RETURN styles FOR DIV ($style_div) AND FOR IMG ($style_img)
	
	list($style_div,$style_img) = image2div($src_image, $max_width,$max_height)
	<div style='$style_div'> <img src="..." alt="..." title="..." style='$style_img'></div>

*/

function image2div($src_image, $max_width= 90,$max_height= 90)
{
				
	$top=0;
	$left=0;
	
	list($width,$height)= getimagesize($src_image);
	
		
		
		$rel = ($width/ $max_width);
		$h_result = $height/$rel;
			
	
	if($width>$height && $h_result<$max_height)
	{	
		$rel = ($height/ $max_height);	
		$h_result = $max_height;
		$w_result = $width/$rel;	
		
		$left = (-1)*($w_result - $max_width)/(2);
		//$style_img= "max-height:".$h_result."px;position:absolute; top:-".$top."px; left:-".$left."px; height:".$h_result."px;width:".$w_result."px";
	}	
	else if ($width<$height && $h_result<$max_height)
	{	
		$rel = ($height/ $max_height);	
		$h_result = $max_height;
		$w_result = $width/$rel;	
		
		$left = (-1)*($w_result - $max_width)/(2);
		//$style_img= "max-height:".$h_result."px;position:absolute; top:-".$top."px; left:-".$left."px; height:".$h_result."px;width:".$w_result."px";
	}
	else
	{	
		$rel = ($width/ $max_width);
		$w_result =	$max_width;							
		$h_result = $height/$rel;
		
		$top = (-1)*($h_result - $max_height)/(2);
		//$style_img= "max-width:".$w_result."px;position:absolute; top:-".$top."px; left:-".$left."px;width:".$w_result."px;";
		
	}

	
	
	
	$style_div= "float:left; overflow:hidden; position:relative; border:0px solid #ccc; width:".$max_width."px; height:".$max_height."px;";	
	$style_img= "max-width:".$w_result."px;max-height:".$h_result."px;position:absolute; top:".$top."px; left:".$left."px; height:".$h_result."px;width:".$w_result."px;rel:$rel;height_:$height;width_:$width;";

	return array($style_div,$style_img);
}

function imagecrop($imagen,$ancho,$alto)
{
		$thumbnail_max_width=$ancho;
		$thumbnail_max_height=$alto;
		$thumbnail = $imagen;
		// location of the original image
		$sourcefile = "$imagen";
		// output file
		$targetfile = $thumbnail;
		/* Create a new image object (not neccessarily true colour) */
        $source_id = null;
        // prep according to image type
        if (preg_match('/(jpg|jpeg)$/i',$sourcefile)) $source_id = imageCreatefromjpeg("$sourcefile");
        elseif (preg_match('/(png)$/i',$sourcefile)) $source_id = imageCreatefrompng("$sourcefile");
        elseif (preg_match('/(gif)$/i',$sourcefile)) $source_id = imageCreatefromgif("$sourcefile");
        else die("Unknown image file type");
		/* Get the dimensions of the source picture */
        $source_width = imagesx($source_id);
        $source_height = imagesy($source_id);
		if ($source_width>$source_height) $relacion=$source_height;
		else $relacion=$source_width;

		$target_id=imagecreatetruecolor($ancho, $alto);
		imagecopyresampled($target_id,$source_id,0,0,0,0,$ancho,$alto,$relacion,$relacion);
        imagedestroy($source_id);
        $source_id = $target_id;
		imagejpeg ($target_id,"$targetfile",100); 
}



function whiteBorder($image,$border)
{
	$im=ImageCreateFromJpeg($image);
	$width=ImageSx($im);
	$height=ImageSy($im);
	$img_adj_width=$width+(2*$border);
	$img_adj_height=$height+(2*$border);
	$newimage=imagecreatetruecolor($img_adj_width,$img_adj_height);
	$border_color = imagecolorallocate($newimage, 255, 255, 255);
	imagefilledrectangle($newimage,0,0,$img_adj_width,$img_adj_height,$border_color);
	imageCopyResized($newimage,$im,$border,$border,0,0,$width,$height,$width,$height);
	ImageJpeg($newimage,$image,100); // change here to $add2 if a new image is to be created
}

function create_grey($input,$output)
{
	$bild = imagecreatefromjpeg($input);
	$x = imagesx($bild);
	$y = imagesy($bild);
	for($i=0; $i<$y; $i++)
	{
		for($j=0; $j<$x; $j++)
		{
			$pos = imagecolorat($bild, $j, $i);
			$f = imagecolorsforindex($bild, $pos);
			$gst = $f["red"]*0.15 + $f["green"]*0.5 + $f["blue"]*0.35;
			$col = imagecolorresolve($bild, $gst, $gst, $gst);
			imagesetpixel($bild, $j, $i, $col);
		}
  }
  imagejpeg($bild,$output,100);
}


function facabook_cover( $url, $width, $height, $type)
{
	$id_album_fb = preg_replace('%^(.*?)set=a\.(.*?)\.(.*?)$%', '$2', $url);
	$url_cover_fb = "https://graph.facebook.com/$id_album_fb/picture?type=album&width=".$width."&height=".$height."";
	$url_cover_data_fb = "https://graph.facebook.com/$id_album_fb/?fields=name";
	//width:".$width."px;height:".$height."px;
	
	$url_cover_data_fb = json_decode(file_get_contents($url_cover_data_fb));
		$fb_date=substr($url_cover_data_fb->created_time, 0, stripos($url_cover_data_fb->created_time,'t'));
		$fb_date= strtotime ($fb_date);
		$fb_date= date('M d, Y', $fb_date);
		
		$fb_title= $url_cover_data_fb->name;
		
	if($id_album_fb)
	{
		if($url_cover_fb)
			list($style_div,$style_img) = image2div($url_cover_fb, $width,$height);
		else return "error";
	

		if($type=="gallery")		
		{	$fb_div = "
			<table cellpadding='2' cellspacing='0' class='fb_table' onclick='window.open(\"$url\")' width='100%'>
				<tr valign='middle'>
					<td width='1'><div class='fb_cover' style='height:".($height+4)."px;width:".($width+4)."px' ><div class='' style='$style_div;'><img src='$url_cover_fb' alt='facebook' title='facebook' style='$style_img;' /></div></div></td>
					<td>
						<div class='fb_date'>".$fb_date."</div>
						<div class='fb_title'>".$fb_title."</div>
						<div class='fb_view'><img src='".get_template_directory_uri()."/images/facebook.jpg' alt='facebook' title='facebook' /> Open Facebook Album </div></div></td>";
			$fb_div .=	"</tr>
			</table>
			";	
		}	
		else if ($type=="home")
		{
			$fb_div =
			"<a class='fb_a' href='$url'><div class='fb_div'><div class='fb_cover' style='height:".($height+4)."px;width:".($width+4)."px' ><div class='' style='$style_div;'><img src='$url_cover_fb' alt='facebook' title='facebook' style='$style_img;' /></div></div>
					<div class='fb_title'>".cut($fb_title,20)."</div></div></a>";
			
		}
		
	}
	else
		$fb_div= "Invalid Link - Url: $url <br> Id: $id_album_fb - Url_cover: $url_cover_fb";
	return $fb_div;
}


/****************************** FILES ******************************

	DIRECTORY - FOLDER - FILE - DOWNLOAD

*********************************************************************/

function GetDirArray($sPath)
// Muestra el listado de un directorio [$sPath]
{
	//Load Directory Into Array
	$handle=opendir($sPath);
	while ($file = readdir($handle)) if(($file!=".")&($file!=".."))
	$retVal[(isset($retVal))?count($retVal):0] = $file;
	//Clean up and sort
	closedir($handle);
	if ($retVal)
	{
		sort($retVal);
		return $retVal;
	}
	else echo "Empty";
}

function deleteDirectory($dir)
{
	if (!file_exists($dir)) return true;
	if (!is_dir($dir)) return unlink($dir);
	foreach (scandir($dir) as $item)
	{
		if ($item == '.' || $item == '..') continue;
		if (!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) return false;
	}
	return rmdir($dir);
}


function forcedownload($filename)
{
//	$filename = $_GET['file'];

	// required for IE, otherwise Content-disposition is ignored
	if(ini_get('zlib.output_compression'))
	  ini_set('zlib.output_compression', 'Off');

	// addition by Jorg Weske
	$file_extension = strtolower(substr(strrchr($filename,"."),1));

	if( $filename == "" ) 
	{
	  echo "<html><body>ERROR: download file NOT SPECIFIED.</body></html>";
	  exit;
	} elseif ( ! file_exists( $filename ) ) 
	{
	  echo "<html><body>ERROR: File not found.</body></html>";
	  exit;
	};
	switch( $file_extension )
	{
	  case "pdf": $ctype="application/pdf"; break;
	  case "exe": $ctype="application/octet-stream"; break;
	  case "zip": $ctype="application/zip"; break;
	  case "doc": $ctype="application/msword"; break;
	  case "xls": $ctype="application/vnd.ms-excel"; break;
	  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	  case "gif": $ctype="image/gif"; break;
	  case "png": $ctype="image/png"; break;
	  case "jpeg":
	  case "jpg": $ctype="image/jpg"; break;
	  default: $ctype="application/force-download";
	}
	header("Pragma: public"); // required
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false); // required for certain browsers 
	header("Content-Type: $ctype");
	// change, added quotes to allow spaces in filenames, by Rajkumar Singh
	header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	readfile("$filename");
	exit();
}

function curPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}


function countdown()
{
	$final_date = strtotime('28 March 2013');
	$now = time();
	$timeleft = $final_date-$now;
	$daysleft = round((($timeleft/24)/60)/60)+1;
	if (strlen($daysleft)==3) $fsize = 30; else $fsize=40;

	echo "<b><span style='font-size:".$fsize."px;color:#fff'>".$daysleft."</span>";
	echo '<br><span style="color:#fff;font-size:9px">DAYS LEFT</span></b></div></td>';

//	echo "<b><span style='font-size:22px;color:#fff'>NOW</span>";
//	echo '<br><span style="color:#fff;font-size:9px">HAPPENING</span></b></div></td>';
}


/*****
*********** SEARCH ************

How to use it!
search_bd
(
	string with the name of the columns, 
	string with the name of the tables, 
	string with the keywords, 
	string with the name of de columns to short the search, 
	beginning of the style to apply to the keywords found in the text, 
	end of the style to apply to the keywords found in the text,
	beginning of the style to apply to the full text,
	end of the style to apply to the full text,
	max size of the text to show
)


Fast use! COPY PASTE 
=========================> fill quotes
$namecolumns = "";
$nametables = "";
$keywords = createVariablePost('keywords');
$stylewordini="";
$stylewordend="";
$styletextrowini="";
$styletextrowend="";
search_bd($namecolumns,$nametables,$keywords,$nameorders,$stylewordini,$stylewordend,$styletextrowini,$styletextrowend);

or without styles, JUST UNDERLINE
search_bd($namecolumns,$nametables,$keyword);
****/
//Delimitadores

	$stylewordini="<keyword>";
	$stylewordend="</keyword>";
	
	$styletextrowini="<text_all>";
	$styletextrowend="</text_all>";
	
	$styletextcolini="<text_single>";
	$styletextcolend="</text_single>";
	
function search_bd($namecolumns,$nametables,$keywords, $nameorders="", &$contentsearch, $textleng=100 )
{	
	//Delimitadores
	global $stylewordini, $stylewordend, $styletextrowini, $styletextrowend, $styletextcolini, $styletextcolend;
	
	$listid = ""; // In list id there are all ids that we'll show
	$colname = explode (",",$namecolumns);
	$tablename = explode (",",$nametables);
	$ordersname = explode (",",$nameorders);
	$numorders = count($ordersname);
	$numcolumns= count($colname);
	//createVariablePost('keywords');
	Conectar();
	$numsearch=0;
	$numresults=0;
	$numresutlstotal=0;
	
	
	
	if($numcolumns>0)
	{	
		while ($numsearch<3)
		//while ($numresults==0 && $numsearch<3)
		{	
			//$searchmode= '"'.$keywords.'"';
			if ($numsearch==0)
			{
				$searchmode= $keywords;
				//$searchmode= str_replace(',',',',$searchmode);
				$query = "SELECT * , MATCH ($namecolumns) AGAINST ('".$searchmode."') AS score FROM $nametables WHERE MATCH ($namecolumns) AGAINST ('".$searchmode."' ) ORDER BY score DESC";
				//echo "0--".$query."<br>";
				
			}
			if ($numsearch==1)
			{
				$searchmode= '"'.$keywords.'"';
				$searchmode= str_replace(',','","',$searchmode);
				$query = "SELECT * , MATCH ($namecolumns) AGAINST ('".$searchmode."' IN BOOLEAN MODE) AS score FROM $nametables WHERE MATCH ($namecolumns) AGAINST ('".$searchmode."' IN BOOLEAN MODE) ORDER BY score DESC";
				//echo "1--".$query."<br>";
			}
			if ($numsearch==2)
			{
				$searchmode= ''.$keywords.'*';
				$searchmode= str_replace(',','*,',$searchmode);
				$query = "SELECT * , MATCH ($namecolumns) AGAINST ('".$searchmode."' IN BOOLEAN MODE) AS score FROM $nametables WHERE MATCH ($namecolumns) AGAINST ('".$searchmode."' IN BOOLEAN MODE) ORDER BY score DESC";
				//echo "2--".$query."<br>";
			}
			
			if($nameorders=="") $query .= ";"; // If there is others 'ORDER BY' columns, we add them to the query
			else
			{
				for($i=0;$i<$numorders;$i++)
					if($i+1 == $numorders) $query .= ", $ordersname[$i] DESC;";
					else $query .= ", $ordersname[$i]";
			}

			//	$query = "SELECT * , MATCH (title, text) AGAINST ('".$searchmode."' IN BOOLEAN MODE) AS score FROM blog WHERE MATCH (title, text) AGAINST ('".$searchmode."' IN BOOLEAN MODE) ORDER BY score DESC, date DESC";
			//echo $query;
			// SELECT * , MATCH ( i.title,  i.text ) AGAINST ('artIST' IN BOOLEAN MODE) OR MATCH (s.title) AGAINST ('artIST' IN BOOLEAN MODE)  AS score FROM  sections s, information_subsections i WHERE MATCH ( i.title,  i.text ) AGAINST ('artIST' IN BOOLEAN MODE) OR MATCH (s.title) AGAINST ('artIST' IN BOOLEAN MODE)  ORDER BY score DESC
			$matchwordtotal	= 0; 
			$result=mysql_query($query);
			$numresults = mysql_numrows($result);
			//echo "<br>Results: $numresults<br>";
			$numsearch++; //counter of the diferent ways to search
			mysql_close();
			for($nrow=0;$nrow<$numresults;$nrow++)	// $nrow is the number of the row of the current search
			{	
				//$keywords= str_replace("+"," ",$keywords);
				$keyword = explode(",", $keywords); //keyword to search in an array
				$score = mysql_result($result,$nrow,"score");
				$id= mysql_result($result,$nrow,id);
				$link= mysql_result($result,$nrow,'subsection');
				
				
				if (!$link ) 
				{	
					$link=mysql_result($result,$nrow,'section');		
				}else if (!file_exists("../en/".$link.".php"))
				{
					$link=str_ireplace("_subsections", "", $nametables);
					
				}
				
				$colvalue= array(); 
				$timescol= array(array());//Number of times that the keyword appeard in a column
				//$colname[$nrow] Could be "id" and $colvalue[$nrow] should be "13"
				
				for($ncol=0;$ncol<$numcolumns;$ncol++)	// $ncol is the number of element that you want to search by and show in the webpage. Number of columns
				{					
					$colvalue[$ncol] = mysql_result($result,$nrow,$colname[$ncol]); //Example (row 0 column 0 with name of the column=title and with value 'AR'. 
					// $colvalue[0] = mysql_result($result, 0, 'title); == 'AR'
					$colvalue[$ncol] = strip_tags($colvalue[$ncol]); // Delete html tags from text variables
					$matchwordtotal	= 0;
					$matchwordcol	=0;			
					for($ntag=0;$ntag<count($keyword);$ntag++) //$keyword[0] is the first keyword
					{	//echo "<br>$ntag -- $keyword[$ntag]";
											
						$keyword[$ntag]= preg_replace("/^[\s\r\t]*(.*?)[\s\r\t]*$/i","$1",$keyword[$ntag]);
						
						str_ireplace("$keyword[$ntag]", $stylewordini."$keyword[$ntag]".$stylewordend, $colvalue[$ncol], $times);
						//echo "<br>$colvalue[$ncol]= str_ireplace($keyword[$ntag], $stylewordini.$keyword[$ntag].$stylewordend, $colvalue[$ncol], $times);";
						if ($times==0)
						{ 	//echo "<br><b>Yiyo0 $times</b><br>";
							if($ntag==0) $colvalue[$ncol] = cut($colvalue[$ncol], $textleng); //if there are more than one keyword, and there is no keywork in all this column, it return the first '$textleng' characters of the field						
						}
						else
						{//echo "<br><b>Yiyo1 $times</b>--> $colvalue[$ncol]<br>";
							$posini = stripos($colvalue[$ncol], $keyword[$ntag]);
							//$pos=stripos($colvalue[$ncol], $keyword[$ntag]);
							if ($posini!== false) $keyword[$ntag] = substr($colvalue[$ncol],$posini,strlen($keyword[$ntag]));
							if($posini<$textleng/2) $posini=0;
							else $posini-=$textleng/2;
																			
							//echo "<br>ini: $posini, end:$posend, total$colvalue[$j]: ".strlen($colvalue[$j]).", totaltext: ".strlen($text)."tag[t]: ".$keyword[$ntag]."<br>searchlen: ".strlen($search)."<br>";
							if($ntag==0)
							{
								$colvalue[$ncol] = substr($colvalue[$ncol], $posini);
								$colvalue[$ncol] = cut($colvalue[$ncol], $textleng + strlen($stylewordini."$keyword[$ntag]".$stylewordend));
								if($posini!=0) $colvalue[$ncol] =  "...".$colvalue[$ncol];
							}
							
							//$colvalue[$j] = str_ireplace($keyword[$j],"<font style='background-color:#990000;'>$keyword[$j]</font>",$colvalue[$j]);
							//str_ireplace($keyword[$j],"<font style='background-color:#990000;'>$keyword[$j]</font>",$text,$numreptext);
							
						}
						$colvalue[$ncol] = str_ireplace("$keyword[$ntag]", $stylewordini."$keyword[$ntag]".$stylewordend, $colvalue[$ncol], $times);					
						$matchwordcol+=$times;
					}	
					
					$matchwordtotal+=$matchwordcol;
					//echo "<br><font style='color=#777777;background-color:#990000;size=5;'> $colname[$ncol] [$textleng]</font> --> $styletextrowini$colvalue[$ncol]$styletextrowini<br>Number of matches: $matchwordcol";
					
				}
				
				
				if(stripos($listid, $id)=== false)
				{
					//$styletextrowini = preg_replace("/^<div (.*?)$/i", "<div onclick='location.href= \"http://www.csarn-craac.ca/en/"."$link".".php\"' $1", $styletextrowini);
					$rowcontent= "$styletextrowini";
					for($ncol=0;$ncol<$numcolumns;$ncol++)	$rowcontent.= "<br>"."$styletextcolini".$colvalue[$ncol]."$styletextcolend";
					$rowcontent.= $styletextrowend;
					$contentsearch.=$rowcontent;
					//echo $rowcontent;
					$numresutlstotal++;
					$listid.= "$id";if ($nrow<$numresults-1)$listid.= "|";
					//echo "$id";
				}
				//echo "<br>RESULT ".($nrow+1)."<BR>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>";
			} 
		}
		
		return $numresutlstotal;
	}
	else
		echo "<br><font color=#333333>ERROR... COLUMNS= 0</font>";
		
	
}

function change_style(&$content, $styleini, $styleend, $type='word',$col=1)
{
//Delimitadores search
	global $stylewordini, $stylewordend, $styletextrowini, $styletextrowend, $styletextcolini, $styletextcolend;
	
	
	if ($type=='word')
	{
		$content = str_replace ($stylewordini, $stylewordini.$styleini, $content);
		$content = str_replace ($stylewordend, $styleend.$stylewordend, $content);
	}
	if ($type=='all')
	{
		$content = str_replace ($styletextrowini, $styletextrowini.$styleini, $content);
		$content = str_replace ($styletextrowend, $styleend.$styletextrowend, $content);
	}
	if ($type=='single')
	{
		$content = str_replace ($styletextrowend, $styletextrowend.'|limit|', $content);
		$acontent = array();
		$acontent = explode('|limit|',$content);
		
		
		for ($i=0; $i<count($acontent)-1;$i++)
		{
			$acontent[$i] = str_replace ($styletextcolend, $styletextcolend.'|limit|', $acontent[$i]);
			
			$acol =  explode('|limit|',$acontent[$i]);
			for ($j=0; $j<count($acol)-1;$j++)
			{
				if($j==($col-1))
				{
					$acol[$j]=str_replace ($styletextcolini, $styletextcolini.$styleini, $acol[$j]);
					$acol[$j]=str_replace ($styletextcolend, $styleend.$styletextcolend, $acol[$j]);
				}
		
			}
			$acontent[$i] = implode('',$acol);
		}
		$content = implode('',$acontent);
		
	}
	
}



?>