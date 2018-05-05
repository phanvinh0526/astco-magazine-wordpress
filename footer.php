<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Wordpress
 * @since wpdance
 */
?>
</div>
<?php $banner_top_right = 'banner-vi-right-your-site'; ?>
<?php if ( is_active_sidebar( $banner_top_right ) ) : ?>
    <div id="divAdRight" style="display: block; position: absolute; z-index:110"> 

        <div class="wd-banner-site-right">
            <?php dynamic_sidebar( $banner_top_right ); ?>
        </div>
    </div>
<?php endif; ?>
<?php $banner_top_left = 'banner-vi-left-your-site'; ?>
<?php if ( is_active_sidebar( $banner_top_left ) ) : ?>
<div id="divAdLeft" style="display: block; position: absolute; z-index:110">
    <div class="wd-banner-site-left">
        <?php dynamic_sidebar( $banner_top_left ); ?>
    </div>
</div>
<?php endif; ?>
<script>
    /*
    function FloatTopDiv()
    {
        startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+90;
        startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+90;
        var d = document;
        function ml(id)
        {
            var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            el.x = startRX;
            el.y = startRY;
            return el;
        }
        function m2(id)
        {
            var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            e2.x = startLX;
            e2.y = startLY;
            return e2;
        }
        window.stayTopLeft=function()
        {
            if (document.documentElement && document.documentElement.scrollTop)
                var pY =  document.documentElement.scrollTop + 150;
            else if (document.body)
                var pY =  document.body.scrollTop + 150;
            if (document.body.scrollTop > 100){startLY = -140;startRY = -140;} else {startLY = TopAdjust;startRY = TopAdjust;};
            ftlObj.y += (pY+startRY-ftlObj.y)/16;
            ftlObj.sP(ftlObj.x, ftlObj.y);
            ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
            ftlObj2.sP(ftlObj2.x, ftlObj2.y);
            setTimeout("stayTopLeft()", 1);
        }
        ftlObj  = ml("divAdRight");
        //stayTopLeft();
        ftlObj2 = m2("divAdLeft");
        stayTopLeft();
    }
    function ShowAdDiv()
    {
        var objAdDivRight = document.getElementById("divAdRight");
        var objAdDivLeft = document.getElementById("divAdLeft");
        if (document.body.clientWidth < 1300)
        {
            objAdDivRight.style.display = "none";
            objAdDivLeft.style.display = "none";
        }
        else
        {
            objAdDivRight.style.display = "block";
            objAdDivLeft.style.display = "block";
            FloatTopDiv();
        }
    }
    document.write("<script type='text/javascript' language='javascript'>MainContentW = 1000;LeftBannerW = 150;RightBannerW = 150;LeftAdjust = 5;RightAdjust = 5;TopAdjust = 10;ShowAdDiv();window.onresize=ShowAdDiv;;<\/script>");*/
</script>
<footer id="footer" class="footer">
	<?php do_action('tvlgiao_wpdance_footer_init_action'); ?>
</footer> <!-- END FOOOTER  -->

</div>
<?php wp_footer(); ?>
</body>
</html>