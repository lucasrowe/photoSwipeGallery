<html>
  <head>
    <!-- justifiedGallery -->
    <link rel="stylesheet" href="justifiedGallery/justifiedGallery.min.css" />

    <!-- Core PhotoSwipe CSS file -->
    <link rel="stylesheet" href="photoswipe/photoswipe.css">

    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
         In the folder of skin CSS file there are also:
         - .png and .svg icons sprite,
         - preloader.gif (for browsers that do not support CSS animations) -->
    <link rel="stylesheet" href="photoswipe/default-skin/default-skin.css">

    <!-- Core JS file -->
    <script src="photoswipe/photoswipe.min.js"></script>

    <!-- UI JS file -->
    <script src="photoswipe/photoswipe-ui-default.min.js"></script>
  </head>
  <body>

  <!-- Code copied from PhotoSwipe website. EDIT WITH CARE -->
  <!-- Root element of PhotoSwipe. Must have class pswp. -->
  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>
    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
      </div>
    </div>
    <!-- End PhotoSwipe -->

    <!-- Gallery -->
    <div class="imageGallery" itemscope itemtype="http://schema.org/ImageGallery">
    <?php

    // This code grabbed from
    // https://davidwalsh.name/generate-photo-gallery

    /* function:  generates thumbnail */
    function make_thumb($src,$dest,$desired_width) {
    	/* read the source image */
    	$source_image = imagecreatefromjpeg($src);
    	$width = imagesx($source_image);
    	$height = imagesy($source_image);
    	/* find the "desired height" of this thumbnail, relative to the desired width  */
    	$desired_height = floor($height*($desired_width/$width));
    	/* create a new, "virtual" image */
    	$virtual_image = imagecreatetruecolor($desired_width,$desired_height);
    	/* copy source image at a resized size */
    	imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
    	/* create the physical thumbnail image to its destination */
    	imagejpeg($virtual_image,$dest);
    }

    /* function:  returns files from dir */
    function get_files($images_dir,$exts = array('jpg')) {
    	$files = array();
    	if($handle = opendir($images_dir)) {
    		while(false !== ($file = readdir($handle))) {
    			$extension = strtolower(get_file_extension($file));
    			if($extension && in_array($extension,$exts)) {
    				$files[] = $file;
    			}
    		}
    		closedir($handle);
    	}
    	return $files;
    }

    /* function:  returns a file's extension */
    function get_file_extension($file_name) {
    	return substr(strrchr($file_name,'.'),1);
    }

    /** settings **/
    $images_dir = 'photos/';
    $thumbs_dir = 'photos-thumbs/';
    $thumbs_width = 1000;
    $images_per_row = 3;

    /** generate photo gallery **/
    $image_files = get_files($images_dir);
    if(count($image_files)) {
    	$index = 0;
    	foreach($image_files as $index=>$file) {
    		$index++;
    		$thumbnail_image = $thumbs_dir.$file;
    		if(!file_exists($thumbnail_image)) {
    			$extension = get_file_extension($thumbnail_image);
    			if($extension) {
    				make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
    			}
    		}

        $size = getimagesize($images_dir.$file);
        $width = explode("\"",$size[3])[1];
        $height = explode("\"",$size[3])[3];
        echo '<a href="',$images_dir.$file,'" class="thumbnail justifiedGallery" itemprop="contentUrl" rel="gallery" data-size="' . $width . "x" . $height . '" data-index="6"><img src="',$thumbnail_image,'" /></a>';
      }
    }
    else {
    	echo '<p>There are no images in this gallery.</p>';
    }
    ?>
  </div>
  </body>

  <!-- justifiedGallery plugin -->
  <script src="justifiedGallery/jquery-2.1.0.min.js"></script>
  <script src="justifiedGallery/jquery.justifiedGallery.min.js"></script>

  <!-- Run custom scripts -->
  <script src="photoSwipeGallery.js"></script>

</html>
