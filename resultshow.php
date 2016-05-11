<html class="">
    <!--STATUS OK-->
    
    <head>		
        <meta name="referrer" content="always">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta name="format-detection" content="telephone=no">
		<title>Nju-Nova-Search</title>
	    <link rel="stylesheet" href="css/resultshow.css" media="screen" type="text/css" />
		
		<script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript">
    function subck(){
	var q = document.getElementById("kw").value;
	if(q==''){return false;}else{return true;}
	}
	</script>

	</head>
	
	<body>
	
	<?php //use scws to participle
	$key = $_GET['key'];
	$key = trim($key);
	 $so = scws_new();
	 $so->set_charset('utf-8');
	 $so->set_dict('/usr/local/scws/etc/dict.utf8.xdb');
	 $so->set_ignore(true);
	 $so->set_multi(true);
	 $so->set_duality(true);
	 $so->send_text($key);
	 $b = array();
	 $a = array();
	 $i=0;
	 while ($res = $so->get_result())
		{
			foreach ($res as $tmp)
			{
				if ($tmp['len'] == 1 && $tmp['word'] == "\r")
					continue;
				if ($tmp['len'] == 1 && $tmp['word'] == "\n")
					echo $tmp['word'];
				else
					$b[$i++]=$tmp['word'];
			}
			flush();
		}
	 $so->close();
	 $keyshow=implode('*',$b);
	 exec('python calculate_d.py '.$keyshow, $a);//use python to deal with the keyword and return parameter
    ?>
        <div id="header">
             <div class="con">
                  <div class="logo png"><img src="./css/homelogo.png" width="100" height="30"
                        alt=""><a href="/">NJU-Search</a></div>
                  <div class="searchbox">
                     <form action="./resultshow.php" method="get" onsubmit="return subck();">
					 <input align="middle" name="key" class="q" id="kw" value="<?php echo $key; ?>" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech />
					 <input name="i" type="hidden" value="0" />
					 <input id="btn" class="btn" align="middle" value="马上搜索" type="submit" />
                     
					 </form>
                  </div>
                  <a href="xssc.html" class="desktop" target="_blank">进入学生手册</a>
             </div>
        </div><!--header-->
		<div id="hd_main">
        <div id="res" class="res">
             <div id="resinfo">NJU-Search为您找到"<h1><?php echo $key; ?></h1>"相关结果<?php $m=sizeof($a); $j=$m/3; echo $j; ?>个</div>
			 <div id="result">	
			     <div class="g"><h2><a class="s" rel="nofollow"><b><?php echo $key; ?></b>NJU-Search</a></h2></br></div>
					<div class="g" >
					<a href="xssc.html#<?php 	$i = $_GET['i']; echo $a[$i++];$n = $i;?>" target="_blank">
					<div id="resultshow1">
				     <?php
						if($i<$m){
						echo $a[$i++];
						 }
						 else{
							 $i++;
						 }
					?></div></a>
					</br>
					<span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; } else{$i++;}?></span>
					  </div>
				      
					 <div class="g">
					 <a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
					 <div id="resultshow2">
				     <?php
					 if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?></div></a>
					</br>
					<span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;} ?></span>
					</div>
					<div class="g">
					<a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
					<div id="resultshow3">
				     <?php
						if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?></div></a></br>
					<span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;} ?></span>
					</div>
					  <div class="g">
					 <a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
					  <div id="resultshow4">
				     <?php
						if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?></div></a></br>
					<span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;} ?></span>
					</div>
			</div> 
			<div id="sopage">
			<?php for($t=0,$s=1;$t<$m&&$s<11;$t=$t+12,$s=$s+1){?>
			<a class="<?php if($s==$i/12) echo 'this';?>" href="./resultshow.php?key=<?php echo $key;?>&i=<?php echo $t;?>" title=""><?php echo $s;?></a><?php }?>
			<a class="n" href="./resultshow.php?key=<?php echo $key;?>&i=<?php $n=$n+12;echo $i;?>" title="下一页">下一页</a>
			</div> 
			</div>	 
		</div>
				 
	
	<script>//obtain the content then display the first 80 characters and use the ... to replace the rest characters
					var oBox1=document.getElementById('resultshow1');
						var resultshow1Html = oBox1.innerHTML.slice(0,80)+'...';
						oBox1.innerHTML = resultshow1Html;
					var oBox2=document.getElementById('resultshow2');
						var resultshow2Html = oBox2.innerHTML.slice(0,80)+'...';
						oBox2.innerHTML = resultshow2Html;
					var oBox3=document.getElementById('resultshow3');
						var resultshow3Html = oBox3.innerHTML.slice(0,80)+'...';
						oBox3.innerHTML = resultshow3Html;
					var oBox4=document.getElementById('resultshow4');
						var resultshow4Html = oBox4.innerHTML.slice(0,80)+'...';
					    oBox4.innerHTML = resultshow4Html;
	</script>
	<script>// highlight the keywords
	function highlight(idVal, keyword) { 
		var textbox = document.getElementById(idVal); 
		//obtain the content of idVal
		if ("" == keyword) return; 
		var temp = textbox.innerHTML; 
		console.log(temp); 
		var htmlReg = new RegExp("\<.*?\>", "i"); 
		var arr = new Array();  
		for (var i = 0; true; i++) { 
		var tag = htmlReg.exec(temp); 
		if (tag) { 
			arr[i] = tag; 
		} else { 
			break; 
		} 
		temp = temp.replace(tag, "{[(" + i + ")]}"); 
		} 
		words = decodeURIComponent(keyword.replace(/\,/g, ' ')).split(/\s+/); 
		//replace the keywords
		for (w = 0; w < words.length; w++) { 
		// keep the special charecter of keywords
			var r = new RegExp("(" + words[w].replace(/[(){}.+*?^$|\\\[\]]/g, "\\$&") + ")", "ig"); 
			temp = temp.replace(r, "<b style='color:Red;'>$1</b>"); 
		} 
		//recovery HTML label
		for (var i = 0; i < arr.length; i++) { 
			temp = temp.replace("{[(" + i + ")]}", arr[i]); 
		} 
		textbox.innerHTML = temp; 
	} 
	highlight("result","<?php $d=sizeof($b); 
								for($c=0;$c<$d-1;$c++){
									echo $b[$c++];
									echo ',';}
									echo $b[$d-1];
									?>"); 
	</script> 	
	</body>
</html>
