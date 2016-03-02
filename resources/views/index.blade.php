@extends('app')

@section('title', 'torrent DB')

@section('content')
<style type="text/css">
	.content {
		width: 600px;
		text-align:center;
		margin:0 auto;
	}
	.logo {
		vertical-align:bottom;
	}
</style>


<div class="content">
	<h1>torrent DB<img class="logo" src="http://www.msarnoff.org/chipdb/logo.png"></h1>

	<div class="search searchbox">
			<input type="text" id="keyword" name="keyword" maxlength="32">
			<input type="submit" value="搜索" onclick="search()">
	</div>

	<p>torrent DB 是一个种子仓库，拥有着全球绝大部分的资源</p>

	<p>需要推荐？试试 
	@foreach($tags as $item)
		<a href="javascript:void(0)" onclick="tags('{{ $item}}')">{{ $item}}</a>
	@endforeach
	</p>

	<p>添加 <a href="javascript:void(0)" onclick="addFavorite()">torrent DB</A> 到你的书签栏!<br><smaill>(复制链接代码，并将它添加到您的书签/收藏)</smaill></p>

	<p>Written and maintained by <a href="http://www.kslr.org">Kslr</a>. Last updated 2016-03-01. <br>Interface design from msarnoff.org.</p>

	<p><a href="mailto:kslrwang@gmail.com (remove the torrentdb)">Feedback</a> | <a href="http://twitter.com/jkslr">Twitter</a></p>
</div>
</body>
<script type="text/javascript">

function search() {
	var keyword = $('#keyword').val();
	if(keyword.length == 0) {
		alert('必须输入一个关键词');
		return false;
	}
	var url =  window.location + 'search/' + keyword + '_1.html';
	console.info(url);
	location.href = url;
}

function tags(keyword) {
	$('#keyword').val(keyword);
	search();
}

function addFavorite() {  
    var url = window.location;  
    var title = document.title;  
    var ua = navigator.userAgent.toLowerCase();  
    if (ua.indexOf("360se") > -1) {  
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");  
    }else if (ua.indexOf("msie 8") > -1) {  
        window.external.AddToFavoritesBar(url, title); //IE8  
    }else if (document.all) {  
        try{  
            window.external.addFavorite(url, title);  
        }catch(e){  
            alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');  
        }  
    } else if (window.sidebar) {  
        window.sidebar.addPanel(title, url, "");  
    } else {  
        alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');  
    }  
} 
</script>
@stop