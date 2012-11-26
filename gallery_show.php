<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <title><? wp_title(); ?></title>
        <link href="<? echo plugins_url() ?>/objects gallery/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<? echo plugins_url() ?>/objects gallery/js/jquery1.8.2.min.js"></script>
        <script>
<?php
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $images = get_posts(array(
        'post_parent' => $postId,
        'post_type' => 'attachment',
        'numberposts' => -1, // show all
        'post_status' => null,
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC',
            ));
    $imagesSize = sizeof($images);
    $upload_dir = wp_upload_dir();
    ?>
            var fpslideshowvar={
                baseurl: "<?php echo $upload_dir['baseurl']; ?>",
                images: [                        
    <?php
    foreach ($images as $image) {
        $index = 0;
        $attimg = wp_get_attachment_image_src($image->ID, 'full');
        $imageSrc = $attimg['0'];
        $imagePath = explode('uploads', $imageSrc);
        ?>
                            [<?php echo $index; ?>, "<?php echo $imagePath['1']; ?>", "<?php echo $image->post_date; ?>"],
                                                                                            
        <?
    }
}
?>
            ["placeholder"]
        ],
        desc: []
    } 
    
    var timthumpPath = '<? echo plugins_url() ?>/objects gallery/timthumb.php';
        </script>




        <script type="text/javascript" src="<? echo plugins_url() ?>/objects gallery/js/fpslideshow.js">

            /***********************************************
             * Full Screen Image Slideshow (w/ auto read images from directory)- by JavaScript Kit (www.javascriptkit.com)
             * This notice must stay intact for usage
             * Visit JavaScript Kit at http://www.javascriptkit.com/ for full source code
             ***********************************************/

        </script>
    </head>

    <body>	
        <section class="text">
            <?php
            if (isset($_GET['post_id'])) {
                $post = get_post($_GET['post_id']);
                ?>
                <h1><?php echo $post->post_title; ?></h1>
                <?php echo $post->post_content; ?>
                <?
            }
            ?>
        </section>

        <section class="share">
            <h1>Share this gallery on:</h1>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50b22d2c028f2616"></script>
            <!-- AddThis Button END -->
        </section>

    </body>
</html>
