<?php
/**
 * info.php
 *
 * 磁力信息页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

include 'config.php';
include APP_ROOT.'/include/core.php'; 
include APP_ROOT.'/include/template/header.php';

$info = get_shahinfo($_GET['magnetic']);
if (isset($info['error'])) {
  header("location: ".$siteconf['url']."?error=3");
  exit();
}

?>
<div class="container">
	<!-- 网站导航栏 -->
		<div class="navbar navbar-default" role="navigation">
	        <div class="navbar-collapse collapse">
		        <ul class="nav navbar-nav">
		            <li><a href="<?php echo $siteconf['url']; ?>">回到首页</a></li>
		        </ul>
	        </div>
    </div>
    <!-- 网站导航栏结束 -->
    <div class="info">

    	<h2><?php echo $info['title']; ?></h2>

    	<div class="btinfo">
    		<p>文件大小：<?php echo $info['size']; ?></p>
    		<p>文件数：<?php echo $info['quantity']; ?></p>
        <p>Hash：<?php echo $_GET['magnetic']; ?></p>
    		<p>创建时间：<?php echo $info['cdate']; ?></p>
    	</div>
    	
    	<div class="link">
    		<p>磁力链接：</p>
    		<pre><?php echo $info['magnetic']; ?></pre>
        <p>（打开迅雷或者旋风，新建任务 复制上面磁力链 即可下载）</p>
    	</div>

    	<div class="filelist">
    		<?php 
    			echo $info['list']['0'].'<br>';
    		?>
    	</div>

    	<div class="dianbo">
            <button class="btn btn-primary" data-toggle="modal" data-target="#qr"><i class="glyphicon glyphicon-qrcode"></i></button>
    	</div>

        <div class="infoad">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- 结果信息 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-7279075760253335"
                 data-ad-slot="3470334951"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

    </div>
    
</div>

<!-- QR -->
<div class="modal fade" id="qr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">QR Code</h4>
      </div>
      <div class="modal-body qr">
        <img src="http://qr.liantu.com/api.php?text=magnet:?xt=urn:btih:<?php echo $_GET['magnetic']; ?>&level=L&size=260">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>


<?php include APP_ROOT.'/include/template/footer.php'; ?>
