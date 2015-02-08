<?php
/**
 * index.php
 *
 * 应用程序首页
 *
 * @author     Kslr
 * @copyright  2014 kslrwang@gmail.com
 * @version    0.3
 */

include dirname(__FILE__).'/config.php';
include APP_ROOT.'/include/core.php'; 
include APP_ROOT.'/include/template/header.php';

if(isset($_GET['error'])) {
  $error_code = intval($_GET['error']);
    switch ($error_code) {
      case '0':
        $default_keyword = '此关键词被列入黑名单！';
        break;
      case '1':
        $default_keyword = '使用了错误的页码';
        break;
      case '2':
        $default_keyword = '抱歉，未能搜索到数据。';
        break;
      case '3':
        $default_keyword = '详情页使用了错误的HASH ！';
        break;
      default:
        $default_keyword = $siteconf['default_keyword'];
        break;
    }
} else {
  $default_keyword = $siteconf['default_keyword'];
}

?>

<div id='warp'>
  <div class="search">
    <div class="logo">
      <img src="<?php echo $siteconf['url'].'public/images/logo.jpg'; ?>" />
    </div>

      <form class="search_form" role="search" method="get" action="search.php">
      <input name="keyword" class="form-control" autofocus="autofocus"  placeholder="<?php echo $default_keyword; ?>" x-webkit-speech lang='zh-CN' required="required"/>
      <button class="btn search_btn" aria-label="搜一下" id="search_btn"><span>搜索</span></button>
      </form>
  </div>

  <div class="navbar footer navbar-fixed-bottom">
    <span id="fsr">
       <span class="_le" >© 2014 BT-SS.com</span>
     </span>
  </div>
</div>

<!-- 网站内容结束 -->

<?php include APP_ROOT.'/include/template/footer.php'; ?>