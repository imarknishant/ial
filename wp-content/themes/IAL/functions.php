<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}



// ============================ SIGNUP FORM FUNCTIONLITY =================================== //

add_action( 'wp_ajax_user_signup', 'user_signup' );
add_action( 'wp_ajax_nopriv_user_signup', 'user_signup' );

function user_signup(){
 
	$username = $_REQUEST['username'];
	$fname = $_REQUEST['first_name'];
	$lname =  $_REQUEST['last_name'];
	$email = sanitize_email($_REQUEST['email']);
	$pass =  $_REQUEST['password'];
	$postalcode = $_REQUEST['postal_code']; 
    $response = array();
    $name = $fname.' '.$lname;
//    $username = substr($_POST['email'], 0, strpos($_POST['email'], '@'));

	if(username_exists($username)){

		$response['status'] = 1;

	}else if( email_exists( $email )){

		$response['status'] = 2;

	}else{
        
		$user_id = wp_create_user($username, $pass, $email);
        
        if($user_id != ''){
        update_user_meta($user_id , 'first_name' ,$fname );
		update_user_meta($user_id , 'last_name' ,$lname );
        
        wp_set_auth_cookie( $user_id, is_ssl() );
        
        $u = new WP_User($user_id);
        
        update_user_meta($user_id,'account_activated',0);
        
		$response['status'] = 3;
        
        
        // create md5 code to verify later
        $code = md5(time());
        // make it into a code to send it to user via email
        $string = array('id'=>$user_id, 'code'=>$code);
        // create the activation code and activation status
        update_user_meta($user_id, 'activation_code', $code);
        
        // create the url
        $url = get_the_permalink(10). '?key=' .base64_encode( serialize($string));
        
        $siteURL = site_url();
        $message = '<head>
   <title>Activation Link</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteURL.'" target="_blank"><img src="https://i.postimg.cc/MGyF45M9/logo.png" border="0" alt="logo"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
            <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hi, '.$fullname.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Thanks for signing up!
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Meanwhile, please verify your email <a href="'.$url.'">(click here)</a> 
                                </p>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        // More headers
//        $headers .= 'From: <Info@ial.video>' . "\r\n";

          //mail($email,'Thanks for registering',$message,$headers);
            $fromaddress=' IAL';
            $subject='Thank you for registration';
            $from='noreply@ial.video';
            $to = $email;
            
            sendmailbysendblue($to,'',$fromaddress,$from,$subject,$message,'','','');       
            
        }

	}
    
    echo json_encode($response);
    
 exit;

}

function sendmailbysendblue($to,$toname,$mailfromname,$mailfrom,$subject,$html,$text,$tag,$replyto){

	$curl = curl_init();
    
$curl = curl_init();
$string['sender'] = array('name'=> $mailfromname, 'email' => $mailfrom);
$to_email = explode(',', $to);
foreach ($to_email as $key => $value) {
$string['to'][] = array('email'=> trim($value));
}

$string['subject'] = $subject;
$string['htmlContent'] = $html;
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>json_encode($string),
		CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			"api-key: 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",
			"content-type: application/json",
			"Cookie: __cfduid=d8718f258a6aca45c4f49c1711b359c6d1604059018"
		),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$results = json_decode($response, true);
    return $results;
}


/********** Check for user account activation *************/

add_action( 'init', 'verify_user_code' );
function verify_user_code(){
    if(isset($_GET['key'])){
        $data = unserialize(base64_decode($_GET['key']));
        $code = get_user_meta($data['id'], 'activation_code', true);
        // verify whether the code given is the same as ours
        if($code == $data['code']){
            // update the user meta
            update_user_meta($data['id'], 'account_activated', 1);
            ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
jQuery(document).ready(function(){
   toastr.success('<strong>Success:</strong> Your account has been activated! ');
});
</script>

<?php
        }
    }
}


/****** Login *******/

add_action('wp_ajax_login', 'login');
add_action('wp_ajax_nopriv_login', 'login');

function login(){
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    
    global $wpdb;
	
	if(email_exists($email))
	{
		$user = get_user_by( 'email', $email );
		$check = $user->ID;
		$result = wp_check_password($password, $user->user_pass, $user->ID);
        
        $user_meta=get_userdata($user->ID);

        $user_roles=$user_meta->roles;
        
        $activate = get_user_meta($user->ID,'account_activated',true);
        
        if($activate != 1){
            
            $response['status'] ="deactivate";  
			$response['type']	= 4;  
			$response['message']="Your Account is deactivated. Please check email for activation link!";
            
        }else{
            
            if ($user && $result ){
            $name = get_user_meta($user->ID,'first_name',true).' '.get_user_meta($user->ID,'last_name',true);
            
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true, false);
              
            $response['status']="success";
            $response['type']	= 1;
            $response['message']="Welcome ".$name." ! Log in successful! , Redirecting... ";
            $response['url'] = get_the_permalink(36);
                
            }else{
                $response['status'] ="error";  
                $response['type']	= 2;  
                $response['message']="Oops ! Password did not match."; 
            }
            
        }

	}else{
		$response['status']="error";   
		$response['type']	= 3;
		$response['message']="Oops ! Email doesn't exist."; 
	}
	
	echo json_encode($response);
    exit();
}


function check_user_role($roles, $user_id = null) {
    if ($user_id) $user = get_userdata($user_id);
    else $user = wp_get_current_user();
    if (empty($user)) return false;

    foreach ($user->roles as $role) {
        if (in_array($role, $roles)) {
            return true;
        }
    }
    return false;
}

// show admin bar only for admins and editors
if (!check_user_role(array('administrator','editor'))) {
  add_filter('show_admin_bar', '__return_false');
}



/****** Update Profile *******/

add_action('wp_ajax_update_profile', 'update_profile');
add_action('wp_ajax_nopriv_update_profile', 'update_profile');

function update_profile(){
    
    $status = array();
    
    update_user_meta($_POST['user_id'],'first_name',$_POST['fname']);
    update_user_meta($_POST['user_id'],'last_name',$_POST['lname']);
    update_user_meta($_POST['user_id'],'description',$_POST['about']);
    
    update_field( 'field_6081284b57671', $_POST['phone'], 'user_'.$_POST['user_id']);
    
    $args = array(
        'ID'         => $_POST['user_id'],
        'user_email' => esc_attr( $_POST['email'] )
    );
    wp_update_user( $args );
    
    
    /**** Update Profile Image Start *****/
    if ( isset($_FILES['profile_image']) ){
 
        $upload = wp_upload_bits($_FILES["profile_image"]["name"], null, file_get_contents($_FILES["profile_image"]["tmp_name"]));
 
        if ( ! $upload['error'] ) {
            $post_id = $userid; //set post id to which you need to set featured image
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
            $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
 
            if ( ! is_wp_error( $attachment_id ) ) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
 
               update_field( 'field_6081283557670', $attachment_id, 'user_'.$_POST['user_id']);
            }
            
        }    
    }
    /**** Update Profile Image End *****/
    
    echo 1;
    
    exit();
}

/****** Update Profile *******/

add_action('wp_ajax_update_password', 'update_password');
add_action('wp_ajax_nopriv_update_password', 'update_password');

function update_password(){
    
    $userObject = get_userdata($_POST['user_id']);
    
    if(wp_check_password($_POST['current_password'], $userObject->user_pass)){
           wp_set_password( $_POST['new_password'], $_POST['user_id'] );
        echo 1;
    }else{
        echo 0;
    }


    exit();
}
/****************************Custom Post Type Competition ********************/
	
	function my_custom_post_competition() {
		$labels = array(
		'name' => 'Competition',
		'singular_name' => 'Competition',
		'add_new' => 'Add Competition',
		'add_new_item' => 'Add Competition',
		'edit_item' => 'Edit Competition',
		'new_item' => 'New Competition',
		'all_items' => 'All Competition',
		'view_item' => 'View Competition',
		'search_items' => 'Search Competition',
		'not_found' =>  'No Competition found',
		'not_found_in_trash' => 'No Competition found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Competition'
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'show_admin_column' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		); 
		
		register_post_type( 'competition', $args ); 
	}  
	add_action( 'init', 'my_custom_post_competition' );
	
	function my_taxonomies_competition() {
		$labels = array(
		'name' 			=>  'Competition Categories',
		'add_new_item'  =>  'Add New Competition category',
		'search_items'  =>  'Search Competition Categories',
		'edit_item' 	=>  'Edit Competition Category',
		'menu_name' 	=>  'Competition Categories'
		);
		$args = array(
		'labels'	    => $labels,
		'hierarchical'  => true,
		'show_admin_column' => true,
		'with_front' => false,
		);
		register_taxonomy( 'competition-category', 'videos', $args );
		
	}
	add_action( 'init', 'my_taxonomies_video');

/****************************Custom Post Type Video ********************/
	
	function my_custom_post_video() {
		$labels = array(
		'name' => 'Videos',
		'singular_name' => 'Videos',
		'add_new' => 'Add Video',
		'add_new_item' => 'Add Video',
		'edit_item' => 'Edit Video',
		'new_item' => 'New Video',
		'all_items' => 'All Videos',
		'view_item' => 'View Videos',
		'search_items' => 'Search Videos',
		'not_found' =>  'No Video found',
		'not_found_in_trash' => 'No Video found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Videos'
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'show_admin_column' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		); 
		
		register_post_type( 'videos', $args ); 
	}  
	add_action( 'init', 'my_custom_post_video' );
	
	function my_taxonomies_video() {
		$labels = array(
		'name' 			=>  'Video Categories',
		'add_new_item'  =>  'Add New video category',
		'search_items'  =>  'Search Video Categories',
		'edit_item' 	=>  'Edit Video Category',
		'menu_name' 	=>  'Video Categories'
		);
		$args = array(
		'labels'	    => $labels,
		'hierarchical'  => true,
		'show_admin_column' => true,
		'with_front' => false,
		);
		register_taxonomy( 'video-category', 'videos', $args );
		
	}
	add_action( 'init', 'my_taxonomies_video');

    function my_taxonomies_video_channel() {
		$labels = array(
		'name' 			=>  'Video Channel',
		'add_new_item'  =>  'Add New video Channel',
		'search_items'  =>  'Search Video Channel',
		'edit_item' 	=>  'Edit Video Channel',
		'menu_name' 	=>  'Video Channel'
		);
		$args = array(
		'labels'	    => $labels,
		'hierarchical'  => true,
		'show_admin_column' => true,
		'with_front' => false,
		);
		register_taxonomy( 'channel', 'videos', $args );
		
	}
	add_action( 'init', 'my_taxonomies_video_channel');

/****************************Custom Post Type My Plans ********************/
	
	function my_custom_post_my_plans(){
		$labels = array(
		'name' => 'Plans',
		'singular_name' => 'Plans',
		'add_new' => 'Add Plans',
		'add_new_item' => 'Add Plans',
		'edit_item' => 'Edit Plans',
		'new_item' => 'New Plans',
		'all_items' => 'All Plans',
		'view_item' => 'View Plans',
		'search_items' => 'Search Plans',
		'not_found' =>  'No Plans found',
		'not_found_in_trash' => 'No Plans found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Plans'
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'show_admin_column' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		); 
		
		register_post_type( 'my-plans', $args ); 
	}  
	add_action( 'init', 'my_custom_post_my_plans' );


/****************************Custom Post Type Portfolio ********************/
	
	function my_custom_post_portfolio() {
		$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Portfolio',
		'add_new_item' => 'Add Portfolio',
		'edit_item' => 'Edit Portfolio',
		'new_item' => 'New Portfolio',
		'all_items' => 'All Portfolio',
		'view_item' => 'View Portfolio',
		'search_items' => 'Search Portfolio',
		'not_found' =>  'No Portfolio found',
		'not_found_in_trash' => 'No Portfolio found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'show_admin_column' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		); 
		
		register_post_type( 'portfolio', $args ); 
	}  
	add_action( 'init', 'my_custom_post_portfolio' );


	function my_taxonomies_portfolio() {
		$labels = array(
		'name' 			=>  'Portfolio Categories',
		'add_new_item'  =>  'Add New Portfolio Categories',
		'search_items'  =>  'Search Portfolio Categories',
		'edit_item' 	=>  'Edit Portfolio Categories',
		'menu_name' 	=>  'Portfolio Categories'
		);
		$args = array(
		'labels'	    => $labels,
		'hierarchical'  => true,
		'show_admin_column' => true,
		'with_front' => false,
		);
		register_taxonomy( 'portfolio-category', 'videos', $args );
		
	}
	add_action( 'init', 'my_taxonomies_portfolio');

/****** Create Channel *******/

add_action('wp_ajax_create_channel', 'create_channel');
add_action('wp_ajax_nopriv_create_channel', 'create_channel');

function create_channel(){
    
    $no_of_channels = 0;
    
    $taxonomies = get_terms( array(
      'taxonomy' => 'channel',
      'hide_empty' => false
     ) );
    foreach($taxonomies as $taxonomy){
        $term_id = $taxonomy->term_id;
        $ch =  get_field('channel_created_by','channel_'.$term_id);

        $ch_user_id = $ch['ID'];
        
        if($ch_user_id==$_POST['userid'] ){
            
            $user_plan = get_field('subscription_plan','user_'.$_POST['userid']); 
            
            if($user_plan == ''){
                $no_of_channels++;
                update_user_meta($_POST['userid'],'number_of_videos',$no_of_channels);
            }
            
        }
    }
    
    /** Check number of channels created **/
    $num_channels = get_user_meta($_POST['userid'],'number_of_videos',true);
    $user_plan = get_field('subscription_plan','user_'.$_POST['userid']);
    
    if($num_channels >= 1 && $user_plan == ''){
        echo 2;
    }else{
        $currentDate = date('d/m/Y');

        $channelSlug = $_POST['userid'].'-'.strtolower($_POST['channel_name']);
        $args = array(
            'description' => $_POST['channel_short_desc'],
            'slug' => $channelSlug,
        );

        $term = wp_insert_term($_POST['channel_name'],'channel',$args);

        update_field('field_60a8dbcc807b7', $_POST['userid'], 'channel_'.$term['term_id']);
        update_field('field_60ffb7b001a34', $currentDate, 'channel_'.$term['term_id']);

        if( isset($_FILES['channel_image']) ){

            $upload = wp_upload_bits($_FILES["channel_image"]["name"], null, file_get_contents($_FILES["channel_image"]["tmp_name"]));

            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );

                if( ! is_wp_error( $attachment_id )){
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    update_field('field_60a8d7cd38cd9', $attachment_id, 'channel_'.$term['term_id']);
                }

            }
                $responce['status'] = 1;
        }  

        if($term != ''){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    exit();
}


/****** Upload Video *******/

add_action('wp_ajax_upload_video', 'upload_video');
add_action('wp_ajax_nopriv_upload_video', 'upload_video');

function upload_video(){
    
    global $wpdb;
    
    $user_id = $_POST['user_id'];
    $currentDate = date('Y-m-d');

    $upload_date = $wpdb->get_results("SELECT * FROM check_video_upload_date WHERE user_id = $user_id");
    
    $count = $upload_date[0]->video_count;
    
    if(!empty($upload_date)){
        if(strtotime($currentDate) < strtotime($upload_date[0]->end_date)){
            
        $newVideoCount = $upload_date[0]->video_count + 1;
        $rowid = $upload_date[0]->ID;
        $wpdb->query("UPDATE check_video_upload_date SET video_count = $newVideoCount WHERE ID = $rowid");
            
        }else{
            
        $video_upload_date = date('Y-m-d',strtotime($currentDate));
        $video_end_date = date('Y-m-d',strtotime($video_upload_date.' + 7 days'));
        $rowid = $upload_date[0]->ID;
        $wpdb->query("UPDATE check_video_upload_date SET start_date = '$video_upload_date', end_date = '$video_end_date', video_count = 1 WHERE ID = $rowid");

        $count = 1;
            
        }
        
    }else{

        $video_upload_date = date('Y-m-d',strtotime($currentDate));
        $video_end_date = date('Y-m-d',strtotime($video_upload_date.' + 7 days'));
        
        $wpdb->insert("check_video_upload_date",array(
            "user_id"=>$user_id,
            "start_date"=>$video_upload_date,
            "end_date"=>$video_end_date,
            "video_count"=>1,
        ));
    }
    
    /*** Number of posts within dates start ***/

    if($count < 5){
    /*** Upload Video Start ***/

    
    $thumbnailid = save_image($_POST['video_thumbnail'],$_POST['video_title']);
    
    $file_name = $_FILES['video_file']['name'];   
	$temp_file_location = $_FILES['video_file']['tmp_name']; 
	
    
    $cat_name = $_POST['cat_name'];
    $cat_id   = $_POST['cat_id'];
    
    $post = array(
        'post_title'    => $_POST['video_title'],
        'post_content'  => $_POST['video_desc'], 
        'post_status'   => 'publish',   // Could be: publish
        'post_type' 	=> 'videos', // Could be: `page` or your CPT
    );
    
    $videoID = wp_insert_post($post);
    
    update_field('channel_name', $cat_name, $videoID);
    update_post_meta($videoID,'post_views_count','0');
    
    wp_set_object_terms( $videoID, array($_POST['video_category']), 'video-category' );
    wp_set_object_terms( $videoID, array($_POST['cat_slug']), 'channel' );
    
    if( isset($_FILES['video_file']) ){
        

    // These files need to be included as dependencies when on the front end.
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
        
    $uploadedfile = $_FILES['video_file'];

    /* You can use wp_check_filetype() function to check the
     file type and go on wit the upload or stop it.*/
    
    $attachment_id = media_handle_upload( 'video_file',$videoID);
        
    update_field('field_609a592595012', $attachment_id, $videoID);
    update_field('field_60e7f3dd9c832', $thumbnailid, $videoID);
 
        // $upload = wp_upload_bits($_FILES["video_file"]["name"], null, file_get_contents($_FILES["video_file"]["tmp_name"]));
 
        // if ( ! $upload['error'] ) {
        //     $post_id = $post_id; //set post id to which you need to set featured image
        //     $filename = $upload['file'];
        //     $wp_filetype = wp_check_filetype($filename, null);
        //     $attachment = array(
        //         'post_mime_type' => $wp_filetype['type'],
        //         'post_title' => sanitize_file_name($filename),
        //         'post_content' => '',
        //         'post_status' => 'inherit'
        //     );
 
        //     $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
 
        //     if( ! is_wp_error( $attachment_id )){
        //         require_once(ABSPATH . 'wp-admin/includes/image.php');
        //         //update_field('field_609a592595012', $attachment_id, 'channel_'.$term['term_id']);
                
        //         update_field('field_609a592595012', $attachment_id, $videoID);
        //         update_field('field_60e7f3dd9c832', $thumbnailid, $videoID);
        //     }
            
        // }
            $response['status'] = 1;
    }
        
    }else{
        $response['status'] = 2;
    }

    echo json_encode($response);

    exit();
}

function save_image( $base64_img, $title ){

	// Upload dir.
    // require_once(ABSPATH . 'wp-admin/includes/image.php');
	$upload_dir  = wp_upload_dir();
	$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

	$img             = str_replace( 'data:image/png;base64,', '', $base64_img );
	$img             = str_replace( ' ', '+', $img );
	$decoded         = base64_decode( $img );
	$filename        = $title . '.png';
	$file_type       = 'image/png';
	$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

	// Save the image in the uploads directory.
	$upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );
    
//    $upload = wp_upload_bits($filename, null, file_put_contents( $upload_path . $hashed_filename, $decoded ));

	$attachment = array(
		'post_mime_type' => $file_type,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
		'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
	);

	$attach_id = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
    
    return $attach_id;
}

/********************* Remove extra <p> <br> ********************/

remove_filter( 'the_content', 'wpautop' );

remove_filter( 'the_excerpt', 'wpautop' );


/**************** Enable OPtions page ACF **************/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}




/****** Upload Video *******/

add_action('wp_ajax_upload_post', 'upload_post');
add_action('wp_ajax_nopriv_upload_post', 'upload_post');

function upload_post(){
    
    global $wpdb;
    
    $response = array();
    
    $post = array(
        'post_title'    => $_POST['post_title'],
        'post_content'  => $_POST['post_desc'], 
        'post_status'   => 'publish',   // Could be: publish
        'post_type' 	=> 'videos', // Could be: `page` or your CPT
    );
    
    $postID = wp_insert_post($post);
    
    wp_set_object_terms( $postID, array($_POST['video_category']), 'video-category' );
    
    if( isset($_FILES['profile_image']) ){
 
        $upload = wp_upload_bits($_FILES["profile_image"]["name"], null, file_get_contents($_FILES["profile_image"]["tmp_name"]));
 
        if ( ! $upload['error'] ) {
            $post_id = $post_id; //set post id to which you need to set featured image
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
            $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
            update_field('image', $attachment_id, $postID);;
            
            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                update_field('field_609a592595012', $attachment_id, 'channel_'.$term['term_id']);
            }
            
        }
            $response['status'] = 1;
    }  
    
    echo json_encode($response);
    exit();
}

/********************* Adding a comment *****************/

    add_action('wp_ajax_add_comments', 'add_comments');
    add_action('wp_ajax_nopriv_add_comments', 'add_comments');

    function add_comments(){
        
        $post_id  = $_POST['post_id'];
        $comments = $_POST['add_comm'];
        $user_id  = $_POST['user_id'];        
        $fName    = get_user_meta($user_id,'first_name');
        $lName    = get_user_meta($user_id,'last_name');
        $fullName = $fName.' '.$lName;     
        $response = array();
        
        $args = array(
        'comment_author'  => $fullName,
        'comment_content' => $comments,
        'comment_post_ID' => $post_id,
        'user_id'         => $user_id,
            
        );
        
        $result = wp_insert_comment($args);
        
        if($result){
            
            $resposne['status'] = 1;
        }
        
        echo json_decode($response);
        exit();

    }


/********************* Adding a Reply *****************/

    add_action('wp_ajax_add_reply_func', 'add_reply_func');
    add_action('wp_ajax_nopriv_add_reply_func', 'add_reply_func');

    function add_reply_func(){
        
        $post_id  = $_POST['post_id'];
        $reply    = $_POST['add_reply'];
        $user_id  = $_POST['user_id']; 
        $commId   = $_POST['comment_id'];
        $fName    = get_user_meta($user_id,'first_name');
        $lName    = get_user_meta($user_id,'last_name');
        $fullName = $fName.' '.$lName;     
        $response = array();
        
        $args = array(
        'comment_author'  => $fullName,
        'comment_content' => $reply,
        'comment_post_ID' => $post_id,
        'user_id'         => $user_id,
        'status'          => 'approve',    
        'comment_parent'  => $commId,
            
        );
        
        $comment_id = wp_new_comment( $args );
        
        $response['status'] = 1;
        
        echo json_decode($response);
        exit();

    }


/************ Like dislike function *************/

    add_action('wp_ajax_like_dislike', 'like_dislike');
    add_action('wp_ajax_nopriv_like_dislike', 'like_dislike');

    function like_dislike(){
       global $wpdb;
        $post_id    = $_POST['post_id'];
        $user_id    = $_POST['user_id'];
        
        $table_name = 'like_dislike';
        
       $sql = "SELECT * FROM like_dislike WHERE Post_id=$post_id AND user_id=$user_id";
       $results = $wpdb->get_results($sql);
        
        if($results){
            
        $like_count = $results[0]->like_count;
            
            if($like_count == 1){

                $wpdb->query($wpdb->prepare("UPDATE $table_name SET like_count=0 WHERE user_id=$user_id"));

            }else{
                $wpdb->query($wpdb->prepare("UPDATE $table_name SET like_count=1 WHERE user_id=$user_id"));
            }
            
        }else{
            
            $wpdb->insert('like_dislike',array(
            'Post_id'   => $post_id,
            'user_id'   => $user_id,
            'like_count' => 1,
    
        ));
            
            
    }
    
        exit();
     
}


/************ Like dislike function *************/

    add_action('wp_ajax_get_likes', 'get_likes');
    add_action('wp_ajax_nopriv_get_likes', 'get_likes');

    function get_likes(){
        global $wpdb;
        $response = array();
        $post_id = $_POST['post_id'];
        $result = $wpdb->get_results( 'SELECT COUNT(like_count) as total_like FROM like_dislike where Post_id="'.$post_id.'" AND like_count=1' );     
        foreach($result as $res){                   
            $like_count =  $res->total_like;
        }
        
        $response['count'] = $like_count;
        echo json_encode($response);
        exit();
    }

/*********************** Channel follow functionlity ********/

    add_action('wp_ajax_follow_channel', 'follow_channel');
    add_action('wp_ajax_nopriv_follow_channel', 'follow_channel');

    function follow_channel(){
        
       global $wpdb;
        
        
       $post_id        = $_POST['post_id'];
       $user_id        = $_POST['user_id'];
       $channel_id = $_POST['channel_id'];
       $channel_owner_id = get_field('channel_created_by','channel_'.$channel_id); 
        
        $table_name = 'channel_follow';
            
        $sql = "SELECT * FROM $table_name WHERE user_id=$user_id AND channel_id=$channel_id";
        $results = $wpdb->get_results($sql);
        
        if(!empty($results)){
                      
            $follow_count = $results[0]->follow_count;        
            
            if($follow_count == 1){
                $result = $wpdb->query($wpdb->prepare("UPDATE $table_name SET follow_count=0 WHERE user_id=$user_id"));
                
                echo 2;
            }else{
                $result = $wpdb->query($wpdb->prepare("UPDATE $table_name SET follow_count=1 WHERE user_id=$user_id"));
                
                echo 1;
            }
        }else{ 
           $result = $wpdb->insert( 'channel_follow' , array(
                    'post_id' => $post_id,
                    'user_id' => $user_id,
                    'channel_id' => $channel_id,
                    'follow_count' => 1,
                    'channel_owner_id' => $channel_owner_id['ID'],
           ));
            
            echo 1;
       }
        
     exit();
        
}


/*********************** Un follow channel functionlity ********/

add_action('wp_ajax_unfollow_channel', 'unfollow_channel');
add_action('wp_ajax_nopriv_unfollow_channel', 'unfollow_channel');

function unfollow_channel(){

    global $wpdb; 

    $user_id = $_POST['user_id'];
    $channel_type = $_POST['channel_type'];
    $owner_id = $_POST['owner_id'];
    
    
    if($channel_type == 'portfolio'){
        $result = $wpdb->query("UPDATE portfolio_follow SET follow_count=0 WHERE followed_by=$user_id AND portfolio_user_id=$owner_id");
    }else{
        $result = $wpdb->query("UPDATE channel_follow SET follow_count=0 WHERE user_id=$user_id AND channel_id=$owner_id");
    }
    
    if($result){
        echo 2;
    }else{
        echo 0;
    }
    exit();
}


// Post views function
function wps_set_post_views( $postID ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ( $count=='' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}


//function time_elapsed_string($datetime, $full = false) {
//    $now = new DateTime;
//    $ago = new DateTime($datetime);
//    $diff = $now->diff($ago);
//
//    $diff->w = floor($diff->d / 7);
//    $diff->d -= $diff->w * 7;
//
//    $string = array(
//        'y' => 'year',
//        'm' => 'month',
//        'w' => 'week',
//        'd' => 'day',
//        'h' => 'hour',
//        'i' => 'minute',
//        's' => 'second',
//    );
//    foreach ($string as $k => &$v) {
//        if ($diff->$k) {
//            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//        } else {
//            unset($string[$k]);
//        }
//    }
//
//    if (!$full) $string = array_slice($string, 0, 1);
//    return $string ? implode(', ', $string) . ' ago' : 'just now';
//}


/******* delete video functionlity ********/

add_action('wp_ajax_delete_video', 'delete_video');
add_action('wp_ajax_nopriv_delete_video', 'delete_video');

function delete_video(){
    
    global $wpdb;
    
    wp_delete_post($_POST['post_id'], true);
    
    $wpdb->query("DELETE FROM like_dislike WHERE Post_id = '".$_POST['post_id']."' AND user_id = '".$_POST['user_id']."'");
    
    $wpdb->query("DELETE FROM channel_follow WHERE post_id = '".$_POST['post_id']."' AND user_id = '".$_POST['user_id']."'");
    
    echo 1;
    
    exit();
}


/****** Create Account With Stripe ******/

//add_action('wp_ajax_connect_with_stripe', 'connect_with_stripe');
//add_action('wp_ajax_nopriv_connect_with_stripe', 'connect_with_stripe');
//
//function connect_with_stripe(){
//    require_once 'stripe/init.php';
//    global $wpdb;
//    $response = array();
//    
//    // Set your secret key. Remember to switch to your live secret key in production.
//    // See your keys here: https://dashboard.stripe.com/apikeys
//    
//    $user = get_user_by( 'email', $_POST['email'] );
//    $userId = $user->ID;
//
//    $stripe = new \stripe\StripeClient(
//    'sk_test_51JDTtIBoP4pOPWX967UkfIzPWvR3zwDxXfNgiszVMk9zTrxn7BMgfhFz3tzKlxAf8abDHOGA4SzaPcYo1K0Edq3e00MwRWZ65e'
//    );    
//    
//    $account = $stripe->accounts->create([
//      'type' => 'standard',
//    ]);
//    
//   $account_link = $stripe->accountLinks->create([
//      'account' => $account->id,
//      'refresh_url' => 'https://customerdevsites.com/ial',
//      'return_url' => 'https://customerdevsites.com/ial/profile-update/#tip',
//      'type' => 'account_onboarding',
//    ]);
//    
//    if($account != ''){
//        $wpdb->insert("connected_accounts",array(
//            "user_account_id"=> $account->id,
//            "date_time"=> $account->created,
//            "site_user_id"=> 0,
//        ));
//    }
//    
//    if($account_link != ''){
//        $response['url'] = $account_link->url;
//        $response['status'] = 1;
//    }else{
//        $response['status'] = 2;
//    }
//    
//    echo json_encode($response);
//    exit();
//    
//}



/****** Subscription With Stripe ******/

add_action('wp_ajax_stripe_payment_func', 'stripe_payment_func');
add_action('wp_ajax_nopriv_stripe_payment_func', 'stripe_payment_func');

function stripe_payment_func(){
//    error_reporting(E_ALL);
//    ini_set('display_errors', '1');
    global $wpdb;
    require_once 'stripe/init.php';
    
    $user_id = $_POST['userid'];
    $plan_id = $_POST['plan_id'];
    $plan_type = $_POST['plan_type'];
    $plan_price = $_POST['plan_amount'];
        
    
    
    /*** Create Customer Stripe ***/
    $userobject = get_userdata($user_id);
    $name = get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
    $email = $userobject->data->user_email;
    
    $customer_id = get_field('customer_id','user_'.$user_id); 
    
    $stripe = new \Stripe\StripeClient('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'
    );
    
    if($customer_id == ''){

    $stripe_customer = $stripe->customers->create([
      'name' => $name,
      'email' => $email,
      'source' => $_POST['stripeToken'],
    ]);
        
    $customerid = $stripe_customer->id;

    update_field( 'field_60f915ff6f002', $customerid, 'user_'.$user_id);
        
    }else{
         $customerid =  get_field('customer_id','user_'.$user_id);
    }

    $intent = $stripe->subscriptions->create([
      "customer" => $customerid, 
      "items" => array( 
        array( 
            "price" => $plan_id, 
        ), 
      ), 
    ]);
    
    
    $transaction_id = $intent->id;
    $date = $intent->created;
    
    $sub_datetime = date('Y-m-d H:i:s');
    $sub_end_datetime = date('Y-m-d H:i:s', strtotime($sub_datetime. ' + 30 days'));
    
    /*** check if plan exists ***/
    
    $plan = $wpdb->get_results("SELECT * FROM subscriptions WHERE user_id = $user_id");

    /** Update Plan in user meta **/
    
    update_field( 'field_60ffbce1532d0', $plan_type, 'user_'.$user_id);
    
    if(empty($plan)){
        if($transaction_id != ''){
        $wpdb->insert("subscriptions",array(
            "transaction_id"=>$transaction_id,
            "date"=>$date,
            "status"=>'success',
            "user_id"=>$user_id,
            "subscription_plan"=>$plan_type,
            "subscription_plan_id"=>$plan_id,
            "plan_price"=>$plan_price,
            "subscription_start"=>$sub_datetime,
            "subscription_end"=>$sub_end_datetime,
        ));
        
        $response['status'] = 1;
        $response['url'] = get_the_permalink(36);

        }else{

        $response['status'] = 0;

        }
    }else{
        
        $row_id = $plan[0]->ID;
        
        $result = $wpdb->query("UPDATE subscriptions SET transaction_id = '$transaction_id', date = '$date', subscription_plan = '$plan_type', subscription_plan_id = '$plan_id', plan_price = '$plan_price', subscription_start = '$sub_datetime', subscription_end = '$sub_end_datetime' WHERE ID = $row_id");

        if($result){
            $response['status'] = 2;
            $response['url'] = get_the_permalink(36);
        }
        
    }
    
    echo json_encode($response);
    
    exit();
}

//function se_10441543_save_post($new_status, $old_status, $post){
//   
//    if('publish' == $new_status && $post->post_type === 'my-plans') {
//        global $wpdb;
//        require_once 'stripe/init.php';       
//        $stripe = new \Stripe\StripeClient(
//          'sk_test_KPpjpp9s8eWPtpqiAq7roPM200ijBnjCDn'
//        );
//        
//         $name = get_the_title($post->ID);
////         $price = get_field('plan_price',$post->ID)*100; 
//         $price = get_post_meta($post->ID,'plan_price',true); 
//        
//        var_dump($name);
//        var_dump($price);
//        die();
//        
//        if($name != '' && $price != ''){
//            
//            echo "yahoooooooooooo";
//            die();
//            
//            $plan = $stripe->plans->create([
//                "product" => [ 
//                    "name" => $name
//                ], 
//                "amount" => $price, 
//                "currency" => 'usd', 
//                "interval" => 'month', 
//                "interval_count" => 1 
//            ]);
//
//            $status = update_post_meta($post->ID,'plan_stripe_ids','sddsdsdsddsdsdsd');
//        }else{
//            echo "ddddddddddddddsdasddsdsdsd";
//            die();
//        }
//        
//    }
//
//
//}

//function fpw_post_info( $id, $post ){
//    
//    echo "ddsdsdsdsddss";
//     echo '<pre>'; print_r( $post ); echo '<br />';
//    // $meta = get_post_meta( $post->ID ); print_r( $meta ); echo '</pre>'; die();
//    // your custom code goes here...
//}
//add_action( 'publish_post', 'fpw_post_info', 10, 2 );

//function afterPostUpdated($meta_id, $post_id, $meta_key='', $meta_value=''){
//
//    $post_status = get_post_status($post_id);
//    $post_type = get_post_type($post_id);
//    
//    $post = get_post($post_id);
//
//    if($post_status == 'publish' && $post_type == 'my-plans'){
//        global $wpdb;
//        require_once 'stripe/init.php';       
//        $stripe = new \Stripe\StripeClient(
//          'sk_test_KPpjpp9s8eWPtpqiAq7roPM200ijBnjCDn'
//        );
//        
//         $name = get_the_title($post_id);
//         $price = get_post_meta($post_id,'plan_price',true)*100; 
//        
//        if($name != '' && $price != ''){
//            $plan = $stripe->plans->create([
//                "product" => [ 
//                    "name" => $name
//                ], 
//                "amount" => $price, 
//                "currency" => 'usd', 
//                "interval" => 'month', 
//                "interval_count" => 1 
//            ]);
//            $status = update_post_meta($post_id,'plan_stripe_ids',$plan->id);
//        }
//        exit();
//    }
//}
//add_action('updated_post_meta', 'afterPostUpdated', 10, 4);


//add_action('post_updated', 'se_10441543_save_post', 10, 3);

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/****** Upload Portfolio Image *******/

add_action('wp_ajax_upload_portfolio_img', 'upload_portfolio_img');
add_action('wp_ajax_nopriv_upload_portfolio_img', 'upload_portfolio_img');

function upload_portfolio_img(){
    
    $response = array();
    
    $post = array(
        'post_title'    => $_POST['protfolio_img_title'],
        'post_content'  => $_POST['protfolio_img_desc'], 
        'post_status'   => 'publish',   // Could be: publish
        'post_type' 	=> 'portfolio', // Could be: `page` or your CPT
    );
    
    $postID = wp_insert_post($post);
    
//    wp_set_object_terms( $postID, array($_POST['video_category']), 'video-category' );
    
    if( isset($_FILES['portfolio_image']) ){
 
        $upload = wp_upload_bits($_FILES["portfolio_image"]["name"], null, file_get_contents($_FILES["portfolio_image"]["tmp_name"]));
 
        if ( !$upload['error'] ){
            $post_id = $postID; //set post id to which you need to set featured image
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
            $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
        
            
            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                
                set_post_thumbnail( $post_id, $attachment_id );
            }
            
        }
            $response['status'] = 1;
    }  
    
    echo json_encode($response);    
    exit();
}


/****** follow portfolio *******/

add_action('wp_ajax_follow_portfolio', 'follow_portfolio');
add_action('wp_ajax_nopriv_follow_portfolio', 'follow_portfolio');

function follow_portfolio(){
    
    global $wpdb;
    $response = array();
    $currentLoggediUser = (int)$_POST['userid'];
    $userid = (int)$_POST['portfolio_user'];
    
    $port_follow_data = $wpdb->get_results("SELECT * FROM portfolio_follow WHERE followed_by = $currentLoggediUser AND portfolio_user_id = $userid");
    
    if(empty($port_follow_data)){
        $result = $wpdb->insert("portfolio_follow",array(
            "followed_by" => $_POST['userid'],
            "portfolio_user_id" => $_POST['portfolio_user'],
            "follow_count" => 1,
        ));
    }else{
        
        if($port_follow_data[0]->follow_count == 1){
            $result = $wpdb->query("UPDATE portfolio_follow SET follow_count = 0 WHERE followed_by = $currentLoggediUser AND portfolio_user_id = $userid");
        }else{
            $result = $wpdb->query("UPDATE portfolio_follow SET follow_count = 1 WHERE followed_by = $currentLoggediUser AND portfolio_user_id = $userid");
        }
        
    }

    
    if($result){
        $response['status'] = 1;
    }else{
        $response['status'] = 0;
    }
    
    echo json_encode($response);
    
    exit();
}

/****** Submit Vote *******/

add_action('wp_ajax_submit_competition', 'submit_competition');
add_action('wp_ajax_nopriv_submit_competition', 'submit_competition');

function submit_competition(){
    global $wpdb;
    
    $userid = $_POST['user_id'];
    $compeid = $_POST['competition_id'];
    $videoid = $_POST['radio'];
    $current_date_time = date('Y-m-d H:i:s');
    
    $result = $wpdb->insert("competition_vote",array(
        "user_id" => $userid,
        "compe_post_id" => $compeid,
        "date_time" => $current_date_time,
        "video_id" => $videoid,
    ));
    
    if($result){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}


/****** Pay Tip ******/

add_action('wp_ajax_pay_tip_with_stripe', 'pay_tip_with_stripe');
add_action('wp_ajax_nopriv_pay_tip_with_stripe', 'pay_tip_with_stripe');

function pay_tip_with_stripe(){

    global $wpdb;
    require_once 'stripe/init.php';
    $response = array();
    
    $user_id = $_POST['userid'];
    $postUserid = $_POST['post_userid'];
    $tip_amount = (int)$_POST['tip_amount'];
    $postID = $_POST['post_id'];
    
    /**** Calculate tip ****/
    
    $user_tip_amount = ($tip_amount/100)*95;
    $admin_tip_amount = ($tip_amount/100)*5;

    /*** Create Customer Stripe ***/
    $userobject = get_userdata($user_id);
    $name = get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
    $email = $userobject->data->user_email;
    
    $postUserName = get_user_meta($postUserid,'first_name',true).' '.get_user_meta($postUserid,'last_name',true);
    
    $description = 'Tip given to '.$postUserName;
    
    $customer_id = get_field('customer_id','user_'.$user_id); 
    
    $stripe = new \Stripe\StripeClient('sk_test_KPpjpp9s8eWPtpqiAq7roPM200ijBnjCDn');
    
    if($customer_id == ''){

    $stripe_customer = $stripe->customers->create([
      'name' => $name,
      'email' => $email,
      'source' => $_POST['stripeToken'],
    ]);
        
    $customerid = $stripe_customer->id;

    update_field( 'field_60f915ff6f002', $customerid, 'user_'.$user_id);
        
    }else{
         $customerid =  get_field('customer_id','user_'.$user_id);
    }
    
    /**** Create Strip Charge Start ****/
    $intent = $stripe->charges->create([
         'amount' => $tip_amount*100,
         'currency' => 'usd',
         'description' => $description,
         'customer' => $customerid,
    ]);
    

    $txn_id = $intent->id;
    $amount = $intent->amount;
    $payment_amount = $amount/100;
    $payment_status = $intent->status;
    $transectionDateTime = date('Y-m-d H:i:s');
    
    /**** Create Strip Charge END ****/
    
    /**** Save transaction to database ****/
    
    $result = $wpdb->insert("tip_payments",array(
        "tranx_id"=>$txn_id,
        "tranx_status"=>$payment_status,
        "tip_given_by"=> $user_id,
        "tip_given_to"=> $postUserid,
        "tip_amount"=> $tip_amount,
        "tip_amount_admin"=> $admin_tip_amount,
        "tip_amount_user"=> $user_tip_amount,
        "tip_date_time"=> $transectionDateTime,
        "tip_post_id"=> $postID,
    ));
    
    if($result){
        $response['status'] =1;
    }else{
        $response['status'] =0;
    }
    
    echo json_encode($response);
    exit();
}

/****** Send Notification ******/

add_action('wp_ajax_send_request', 'send_request');
add_action('wp_ajax_nopriv_send_request', 'send_request');

function send_request(){
    
    $response = array();
    
    if($_POST['radio'] == 'full_amount'){
        $amount = $_POST['total_tip_amount'];
    }else{
        $amount = $_POST['custom_amount'];
    }
    
    $userdata = get_userdata($_POST['userid']);
    $email = $userdata->user_email;
    $username = get_user_meta($_POST['userid'],'first_name',true).' '.get_user_meta($_POST['userid'],'last_name',true);
    
    $siteURL = site_url();
    $message = '<head>
   <title>Tip withdraw request</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteURL.'" target="_blank"><img src="https://i.postimg.cc/MGyF45M9/logo.png" border="0" alt="logo"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, Admin</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                The user '.$username.' has requested the withdraw of amount - $'.$amount.'
                                </p>
                            
                           </td>
                       </tr>

                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@ialdev.customer-devreview.com>' . "\r\n";

        if(mail($email,'Tip Withdraw Request',$message,$headers)){
            $response['status'] = 1;
        }else{
            $response['status'] = 0;
        }
    
    /***** Send email to user *****/
    
        $message_user = '<head>
   <title>Tip withdraw request</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteURL.'" target="_blank"><img src="https://i.postimg.cc/MGyF45M9/logo.png" border="0" alt="logo"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$username.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Your tip withdraw request is under process. We will update you once transaction is complete.
                                </p>
                            
                           </td>
                       </tr>

                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@ialdev.customer-devreview.com>' . "\r\n";

        mail($email,'Tip Withdraw Request',$message_user,$headers);
    
    echo json_encode($response);
    exit();
}


/****** Forgot Password ******/

add_action('wp_ajax_forgot_password', 'forgot_password');
add_action('wp_ajax_nopriv_forgot_password', 'forgot_password');

function forgot_password(){
    $response = array();
     global $wpdb;
    
    if(email_exists($_POST['email'])){
        
    $userData = get_user_by('email', $_POST['email']);
    $name = get_user_meta($userData->data->ID,'first_name',true);
    $email = $_POST['email'];
    $hash_password = wp_hash_password($password);
    wp_set_password( $hash_password, $userData->data->ID );


    $siteURL = site_url();
    $message = '<head>
   <title>Forgot Password</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteURL.'" target="_blank"><img src="https://i.postimg.cc/MGyF45M9/logo.png" border="0" alt="logo"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hi, '.$name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Please find the below new generated password.
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    New Password - '.$hash_password.'
                                </p>
                           </td>
                       </tr>

                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
        // Always set content-type when sending HTML email
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@ialdev.customer-devreview.com>' . "\r\n";

        if(mail($email,'Forgot Password',$message,$headers)){
            
        $response['status'] = 1;
        }else{
            
        $response['status'] = 2;
        }
        
  
    }else{
        $response['status'] = 0;
    }
    
    echo json_encode($response);
    
    exit();   
}


function time_elapsed_string($ptime){
    
    // Past time as MySQL DATETIME value
    $ptime = strtotime($ptime);

    // Current time as MySQL DATETIME value
    $csqltime = date('Y-m-d H:i:s');

    // Current time as Unix timestamp
    $ctime = strtotime($csqltime); 

    // Elapsed time
    $etime = $ctime - $ptime;

    // If no elapsed time, return 0
    if ($etime < 1){
        return '0 seconds';
    }

    $a = array( 24 * 60 * 60  =>  'day');

    $a_plural = array('day'  => 'days');

    foreach ($a as $secs => $str){
        // Divide elapsed time by seconds
        $d = $etime / $secs;
        if ($d >= 1){
            // Round to the next lowest integer 
            $r = floor($d);
            // Calculate time to remove from elapsed time
            $rtime = $r * $secs;
            // Recalculate and store elapsed time for next loop
            if(($etime - $rtime)  < 0){
                $etime -= ($r - 1) * $secs;
            }
            else{
                $etime -= $rtime;
            }
            // Create string to return
            $estring = $estring . $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ';
        }
    }
    return $estring . ' ago';
}

 add_action( 'delete_post', 'my_delete_function' );
 function my_delete_function() { 
   //delete some stuff
   global $post,$wpdb;
   $id = $post->ID;
   $wpdb->query("DELETE FROM like_dislike WHERE Post_id=$id");
 }
 
 
 /******save_interest******/

add_action('wp_ajax_save_interest', 'save_interest');
add_action('wp_ajax_nopriv_save_interest', 'save_interest');

function save_interest(){
    
    if(update_user_meta($_POST['userid'],'area_of_interest',$_POST['interest'])){
        echo 1;
    }else{
        echo 2;
    }
    
    exit();
}

