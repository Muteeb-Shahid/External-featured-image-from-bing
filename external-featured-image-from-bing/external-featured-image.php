<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              xaraar.com
 * @since             1.0.0
 * @package           External_Featured_Image
 *
 * @wordpress-plugin
 * Plugin Name:       Featured image from External URL or bing
 * Plugin URI:        Featured image from External URL or bing
 * Description:       Adds functionality to search images from post page and attach as featured image
 * Version:           1.0.2
 * Author:            xaraartech
 * Author URI:        xaraar.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       external-featured-image
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-external-featured-image-activator.php
 */
function efifb_activate_external_featured_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-external-featured-image-activator.php';
	External_Featured_Image_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-external-featured-image-deactivator.php
 */
function efifb_deactivate_external_featured_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-external-featured-image-deactivator.php';
	External_Featured_Image_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'efifb_activate_external_featured_image' );
register_deactivation_hook( __FILE__, 'efifb_deactivate_external_featured_image' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-external-featured-image.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function efifb_run_external_featured_image() {

	$plugin = new External_Featured_Image();
	$plugin->run();

}
efifb_run_external_featured_image();



/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'efifb_smashing_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'efifb_smashing_post_meta_boxes_setup' );


/* Meta box setup function. */
function efifb_smashing_post_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'efifb_smashing_add_post_meta_boxes' );
}

function efifb_smashing_add_post_meta_boxes() {

  	add_meta_box(
    'smashing-post-class',      // Unique ID
    esc_html__( 'External Featured Images ', 'external-featured-image' ),    // Title
    'efifb_smashing_post_class_meta_box',   // Callback function
    'post',         // Admin page (or post type)
    'side',         // Context
    'default'         // Priority
  	);
	add_meta_box(
    'smashing-post-class',      // Unique ID
    esc_html__( 'External Featured Images ', 'external-featured-image' ),    // Title
	    'efifb_smashing_post_class_meta_box',   // Callback function
	    'page',         // Admin page (or post type)
	    'side',         // Context
	    'default'         // Priority
  	);
 	add_meta_box(
	    'smashing-post-class',      // Unique ID
	    esc_html__( 'External Featured Images ', 'external-featured-image' ),    // Title
	    'efifb_smashing_post_class_meta_box',   // Callback function
	    'product',         // Admin page (or post type)
	    'side',         // Context
	    'default'         // Priority
  	);

  	add_meta_box(
	    'smashing-post-class-external-url',      // Unique ID
	    esc_html__( 'Featured Images from URL', 'external-featured-image' ),    // Title
	    'efifb_smashing_from_url_post_class_meta_box',   // Callback function
	    'post',         // Admin page (or post type)
	    'side',         // Context
	    'default'         // Priority
  	);

  	add_meta_box(
	    'smashing-post-class-external-url',      // Unique ID
	    esc_html__( 'Featured Images from URL', 'external-featured-image' ),    // Title
	    'efifb_smashing_from_url_post_class_meta_box',   // Callback function
	    'page',         // Admin page (or post type)
	    'side',         // Context
	    'default'         // Priority
  	);

  	add_meta_box(
	    'smashing-post-class-external-url',      // Unique ID
	    esc_html__( 'Featured Images from URL', 'external-featured-image' ),    // Title
	    'efifb_smashing_from_url_post_class_meta_box',   // Callback function
	    'product',         // Admin page (or post type)
	    'side',         // Context
	    'default'         // Priority
  	);



}


/* Display the post meta box. */
function efifb_smashing_post_class_meta_box( $post ) { 

    $q = efifb_removeCommonWords(get_the_title());

    ?>
  <p>
  <form>
    <input class="widefat" type="text" name="externalImagesKeyword" id="externalImagesKeyword" value="<?php echo $q ?>" size="30" />
    <input type="button"  id="searchAndLoadExternalImages" value="Search Images">
   </form>
  </p>
  <div class="externalImages"></div>
  <?php wp_nonce_field( basename( __FILE__ ), 'efifb_smashing_post_class_nonce' );

 }

 /* Display the post meta box. */
function efifb_smashing_from_url_post_class_meta_box( $post ) { 
    ?>
  <p>
  <form>
    <input class="widefat" type="text" name="externalImagesURL" id="externalImagesURL" value="" size="30" />
    <input type="button"  id="downloadImageFromURL" value="Import Image">
   </form>
  </p>
  <div class="externalURLImages"></div>
  <?php wp_nonce_field( basename( __FILE__ ), 'efifb_smashing_post_class_nonce' );

 }



function efifb_removeCommonWords($input){
 
    $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
    return preg_replace('/\b('.implode('|',$commonWords).')\b\s/i','',$input);
}


add_action( 'admin_footer', 'efifb_my_action_javascript' ); // Write our JS below here

function efifb_my_action_javascript() { 
	global $post;
	?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
	
		jQuery(document).on('click', '.userExternalImageasFeatured', function(){
			jQuery(this).attr('disabled', 'disabled');
			var data = {
				'action': 'efifb_downloadAndSetImage',
				'imageSrc': jQuery(this).data('imagesrc'),
				'post_id': <?php echo $post->ID ?>
			};

			jQuery.post(ajaxurl, data, function(response) {
				alert('Featured Image set.');
				jQuery(this).removeAttr('disabled');
				jQuery('#_thumbnail_id').val(response);
			});
		});

		jQuery(document).on('click', '#searchAndLoadExternalImages', function(){
			jQuery(this).attr('disabled', 'disabled');
			if( jQuery('#externalImagesKeyword').val() != ''){
				jQuery('.externalImages').html('Loading images...');
			var data = {
				'action': 'efifb_my_action',
				'featuredImageKeyword': jQuery('#externalImagesKeyword').val()
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('.externalImages').html(response);
				jQuery(this).removeAttr('disabled');
			});
		}
		});

		if( jQuery('#externalImagesKeyword').val() != ''){


		var data = {
				'action': 'efifb_my_action',
				'featuredImageKeyword': jQuery('#externalImagesKeyword').val()
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('.externalImages').html(response);
			});
			}

	jQuery(document).on('click', '#downloadImageFromURL', function(){
			jQuery(this).attr('disabled', 'disabled');
			var data = {
				'action': 'efifb_downloadAndSetImageURL',
				'imageSrc': jQuery('#externalImagesURL').val(),
				//'imageSrc': jQuery(this).data('imagesrc'),
				'post_id': <?php echo $post->ID ?>
			};

			jQuery.post(ajaxurl, data, function(response) {
				alert('Featured Image set.');
				jQuery(this).removeAttr('disabled');
				jQuery('#_thumbnail_id').val(response);
			});
	});

	});
	</script> <?php
}

add_action( 'wp_ajax_my_action', 'efifb_my_action' );

function efifb_my_action() {


	 $url =  "https://api.cognitive.microsoft.com/bing/v5.0/images/search?count=20&q=".urlencode(  filter_input(INPUT_POST, 'featuredImageKeyword'));

	try{

		$options = get_option( 'efise_settings' );

		if( empty( $options['efise_bing_api_key'] )   ){
			echo  'Please Set API Key';
			wp_die(); // this is required to terminate immediately and return a proper response
		}

		$response = wp_remote_get( $url, 
    	array( 'timeout' => 620, 
    		'headers' => array( 'Ocp-Apim-Subscription-Key' => $options['efise_bing_api_key']) 
             ) 
    	);
		echo '<div class="external-images-container">';
	    $i = json_decode($response['body']);
	    foreach ($i->value as $key => $img) {
	        echo "<img width='150' src='$img->thumbnailUrl' />";
	        echo '<input type="button" class="userExternalImageasFeatured"  data-imagesrc="'.$img->contentUrl.'" value="use this"/>';
	        echo '<hr />';
	    }	
	    echo  '</div>';
	}
	catch( Exception $ex){
		echo $ex->getMessage();
	}
    

	wp_die(); // this is required to terminate immediately and return a proper response
}




add_action( 'wp_ajax_efifb_downloadAndSetImage', 'efifb_downloadAndSetImage' );

function efifb_downloadAndSetImage() {

	echo $s = parse_url(( filter_input(INPUT_POST, 'imageSrc') ));
	$a = parse_str($s['query'], $as);
	echo $filename_from_url = parse_url($as['r']);
	echo $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
	$post_id = filter_input(INPUT_POST, 'post_id') ;
	// Add Featured Image to Post
	//$image_url        = 'http://s.wordpress.org/style/images/wp-header-logo.png'; // Define the image URL here
	$image_url        = $as['r']; // Define the image URL here
	$image_name       = rand().'.'.$ext;
	$upload_dir       = wp_upload_dir(); // Set upload folder
	$image_data       = file_get_contents($image_url); // Get image data

	$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
	$filename         = basename( $unique_file_name ); // Create image file name

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
	    $file = $upload_dir['path'] . '/' . $filename;
	} else {
	    $file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
	    'post_mime_type' => $wp_filetype['type'],
	    'post_title'     => sanitize_file_name( $filename ),
	    'post_content'   => '',
	    'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );
	echo $attach_id;
	wp_die();

}

add_action( 'wp_ajax_efifb_downloadAndSetImageURL', 'efifb_downloadAndSetImageURL' );

function efifb_downloadAndSetImageURL() {

	$filename_from_url = parse_url(filter_input(INPUT_POST, 'imageSrc'));
	
	$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
	$post_id = filter_input(INPUT_POST, 'post_id') ;
	// Add Featured Image to Post
	//$image_url        = 'http://s.wordpress.org/style/images/wp-header-logo.png'; // Define the image URL here
	$image_url        = filter_input(INPUT_POST, 'imageSrc'); // Define the image URL here
	$image_name       = rand().'.'.$ext;
	$upload_dir       = wp_upload_dir(); // Set upload folder
	$image_data       = file_get_contents($image_url); // Get image data

	$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
	$filename         = basename( $unique_file_name ); // Create image file name

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
	    $file = $upload_dir['path'] . '/' . $filename;
	} else {
	    $file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
	    'post_mime_type' => $wp_filetype['type'],
	    'post_title'     => sanitize_file_name( $filename ),
	    'post_content'   => '',
	    'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );
	echo $attach_id;
	wp_die();

}




add_action( 'admin_menu', 'efise_add_admin_menu' );
add_action( 'admin_init', 'efise_settings_init' );


function efise_add_admin_menu(  ) { 

	add_menu_page( 'External featured image', 'External featured', 'manage_options', 'external_featured_image_from_search_engines', 'efise_options_page' );

}


function efise_settings_init(  ) { 

	register_setting( 'pluginPage', 'efise_settings' );

	add_settings_section(
		'efise_pluginPage_section', 
		__( '', 'efise' ), 
		'efise_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'efise_bing_api_key', 
		__( 'Bing API Key 1', 'efise' ), 
		'efise_bing_api_key_render', 
		'pluginPage', 
		'efise_pluginPage_section' 
	);

	add_settings_field( 
		'efise_bing_api_key_2', 
		__( 'Bing API Key 2', 'efise' ), 
		'efise_bing_api_key_2_render', 
		'pluginPage', 
		'efise_pluginPage_section' 
	);

	// add_settings_field( 
	// 	'efise_text_field_2', 
	// 	__( 'API Key', 'efise' ), 
	// 	'efise_text_field_2_render', 
	// 	'pluginPage', 
	// 	'efise_pluginPage_section' 
	// );


}


function efise_bing_api_key_render(  ) { 

	$options = get_option( 'efise_settings' );
	?>
	<input type='text' name='efise_settings[efise_bing_api_key]' value='<?php echo $options['efise_bing_api_key']; ?>'>
	<?php

}


function efise_bing_api_key_2_render(  ) { 

	$options = get_option( 'efise_settings' );
	?>
	<input type='text' name='efise_settings[efise_bing_api_key_2]' value='<?php echo $options['efise_bing_api_key_2']; ?>'>
	<?php

}


function efise_text_field_2_render(  ) { 

	$options = get_option( 'efise_settings' );
	?>
	<input type='text' name='efise_settings[efise_text_field_2]' value='<?php echo $options['efise_text_field_2']; ?>'>
	<?php

}


function efise_settings_section_callback(  ) { 

	echo __( 'Set search engine Keys', 'efise' );

}


function efise_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>External featured image from search engines</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}



