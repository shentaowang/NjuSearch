<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,user-scalable=no" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<title>Nju-Nova-Search</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="canonical" href="http://so.iliema.com/soso/5a2m55Sf6K!B" />
<link href="css/wapshow.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
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
<div class="logo"><a href="/" title="Nju搜索"><img  width="150" src="./css/homelogo.png" alt="Nju-Nova-Search" /></a></div>
<div class="searchbox">
    <form action="./wapshow.php" method="get"><input align="middle" name="key" class="q" id="kw" value="<?php echo $key; ?>" maxlength="1000" baiduSug="1" autocomplete="off" x-webkit-speech />
	<input name="i" type="hidden" value="0" /><input id="btn" class="btn" align="middle" value="搜索" type="submit" />
    </form>
</div>
<div id="hd_main">
	<div class="res">
		<div id="resinfo">NJU-Search为您找到"<h1><?php echo $key; ?></h1>"相关结果<?php $m=sizeof($a); $j=$m/3; echo $j; ?>个</div>
		<div id="result">
		<div class="g">
			<div class="g" >
			<a href="xssc.html#<?php 	$i = $_GET['i']; echo $a[$i++];$n = $i;?>" target="_blank">
			<div id="resultshow1"><?php
						if($i<$m){
						echo $a[$i++];
						 }
						 else{
							 $i++;
						 }
					?></div></a></br>
			<span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;}?></span>
			</div>    
			<div class="g" >
			<a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
			<div id="resultshow2">
						<?php
						if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?>
						</div></a></br><span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;}?></span></div> 
	
			<div class="g">
			<a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
			<div id="resultshow3">
						<?php
						if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?>
						</div></a></br><span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;}?></span></div> 
	
			<div class="g">
			<a href="xssc.html#<?php echo $a[$i++];?>" target="_blank">
			<div id="resultshow4"> 
						<?php
						if($i<$m){
						echo $a[$i++];
						 } else{
							 $i++;
						 }
					?>
					</div></a></br><span class="a"><?php if($i<$m) {echo $a[$i++]; echo'</br>'; echo'</br>'; }else{$i++;}?></span></div> 
		</div>
	<input name="i" id="pagenum" type="hidden" value="2" />
		</div>
		<div id="sopage">
				<?php for($t=0,$s=1;$t<$m&&$s<8;$t=$t+12,$s=$s+1){?>
				<a class="<?php if($s==$i/12) echo 'this';?>" href="./wapshow.php?key=<?php echo $key;?>&i=<?php echo $t;?>" title=""><?php echo $s;?></a><?php }?>
				<a class="n" href="./wapshow.php?key=<?php echo $key;?>&i=<?php $n=$n+12;echo $i;?>" title="下一页">下一页</a>
		</div>
	</div>
</div>
<div class="searchbox">
    <form action="./wapshow.php" method="get"><input align="middle" name="key" class="q" id="kw" value="<?php echo $key; ?>" maxlength="100" autocomplete="off" x-webkit-speech />
    <input name="i" type="hidden" value="0" /><input id="btn" class="btn" align="middle" value="搜索" type="submit" />
	</form>
</div>

<div id="footer"><p><a href="./index.html">电脑版</a></p>Copyright &copy; 2016-

<a href="./wap.html" target="_blank"> NJU搜索 </a> 
<a href="/" target="_blank">NJU搜索</a> </div>
<script> //obtain the content then display the first 80 characters and use the ... to replace the rest characters
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
	function highlight(idVal, keyword) { //highlight the keywords
		var textbox = document.getElementById(idVal); 
		if ("" == keyword) return; 
		//obtain the content of idVal
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