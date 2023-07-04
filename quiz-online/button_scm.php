button_share img {
width: 36px;
box-shadow: 0;
padding: 6px;
display: inline;
border: 0;
}


<?php 
    // pass web-site url
    $site_url  = "http://www.onlinecode/blog";
    // post title
    $site_title  = "onlinecode";
?>

<!-- <a> tab for http://www.onlinecode/blog share link for social media -->
<div id="button_share">
    
    <!-- Buffer Social Media -->
    <a href="https://bufferapp.com/add?url=<?=$site_url?>&amp;text=<?=$site_title?>" target="_blank">
        <img src="http://www.onlinecode/example/images/buffer.png" alt="Buffer share link" />
    </a>
    
    <!-- Digg Social Media -->
    <a href="http://www.digg.com/submit?url=<?=$site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/diggit.png" alt="Digg  share link" />
    </a>
    
    <!-- Email Social Media -->
    <a href="mailto:?Subject=<?=$site_title?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?=$site_url?>">
        <img src="http://www.onlinecode/example/images/email.png" alt="Email share link" />
    </a>
 
    <!-- Facebook Social Media -->
    <a href="http://www.facebook.com/sharer.php?u=<?=$site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/facebook.png" alt="Facebook share link" />
    </a>
    
    <!-- Google+ Social Media -->
    <a href="https://plus.google.com/share?url=<?=$site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/google.png" alt="Google share link" />
    </a>
    
    <!-- LinkedIn Social Media -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=$site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/linkedin.png" alt="LinkedIn share link" />
    </a>
    
    <!-- Pinterest Social Media -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
        <img src="http://www.onlinecode/example/images/pinterest.png" alt="Pinterest share link" />
    </a>
    
    <!-- Print Social Media -->
    <a href="javascript:;" onclick="window.print()">
        <img src="http://www.onlinecode/example/images/print.png" alt="Print share link" />
    </a>
    
    <!-- Reddit Social Media -->
    <a href="http://reddit.com/submit?url=<?=$site_url?>&amp;title=<?=$site_title?>" target="_blank">
        <img src="http://www.onlinecode/example/images/reddit.png" alt="Reddit share link" />
    </a>
    
    <!-- StumbleUpon Social Media -->
    <a href="http://www.stumbleupon.com/submit?url=<?=$site_url?>&amp;title=<?=$site_title?>" target="_blank">
        <img src="http://www.onlinecode/example/images/stumbleupon.png" alt="StumbleUpon share link" />
    </a>
    
    <!-- Tumblr Social Media -->
    <a href="http://www.tumblr.com/share/link?url=<?=$site_url?>&amp;title=<?=$site_title?>" target="_blank">
        <img src="http://www.onlinecode/example/images/tumblr.png" alt="Tumblr share link" />
    </a>
     
    <!-- Twitter Social Media -->
    <a href="https://twitter.com/share?url=<?=$site_url?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
        <img src="http://www.onlinecode/example/images/twitter.png" alt="Twitter share link" />
    </a>
    
    <!-- vkontakte Social Media -->
    <a href="http://vkontakte.ru/share.php?url=<?=$site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/vk.png" alt="VK share link" />
    </a>
    
    <!-- Yummly Social Media -->
    <a href="http://www.yummly.com/urb/verify?url=<?=$site_url?>&amp;title=<?=$site_title?>" target="_blank">
        <img src="http://www.onlinecode/example/images/yummly.png" alt="Yummly share link" />
    </a>

</div>