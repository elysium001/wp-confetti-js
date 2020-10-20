<?php

class TechGBlocks {

	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
            self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;
        // self::create_block_gnosis_container_block_block_init();
        // [bartag foo="foo-value"]

        add_shortcode( 'confetti', array( 'TechGBlocks', 'do_confetti' ) );
    }

    public static function do_css(){
        ?>
        <style>
        .modal-window {
            position: fixed;
            background-color: rgba(255, 255, 255, 0.25);
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s;
        }

        .modal-window canvas {
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
        }

        #confetti-content {
            z-index: 22;
            width: 450px;
            background-color: rgba(255,255,255,0.8);
            padding: 24px;
            display: block;
            align-self: center;
            opacity: 1;
            font-family: 'p22-underground','Lato',helvetica,sans-serif;
        }

        .modal-window.open {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }
        .modal-window>div {
            width: 100%;
            height: 100%;
            position: absolute;
            display: flex;
            justify-content: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2em;
            background: #ffffff;
        }
        .modal-window header {
            font-weight: bold;
        }
        .modal-window h1 {
            font-size: 150%;
            margin: 0 0 15px;
        }

        .modal-close {
            position: absolute;
            right: 32px;
            top: 32px;
            width: 32px;
            height: 32px;
            opacity: 1;
            z-index: 222;
        }

        @media only screen and (max-width: 768px){
            .modal-close {
                right: 16px;
                top: 52px;
            }
        }

        .modal-close:hover {
            opacity: 1;
        }
        .modal-close:before, .modal-close:after {
            position: absolute;
            left: 15px;
            content: ' ';
            height: 33px;
            width: 2px;
            background-color: #333;
        }
        .modal-close:before {
            transform: rotate(45deg);
        }
        .modal-close:after {
            transform: rotate(-45deg);
        }
        .confetti-slide {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .confetti-slide #confetti-content {
            position: absolute;
        }
        </style>
        <?php
    }

    public static function do_confetti( $atts, $content = null ) {
        $a = shortcode_atts( array(
            'popupDelay'=>'1000',
            'shapes'=> 'circle,square,triangle,line',
            'colors' => '244, 228, 164|239, 214, 118|234, 201, 72|228, 187, 27|189, 155, 22|137, 112, 16|91, 75, 11',
            'svg'=> '',
            'max'=> 100,
            'size'=> 2,
            'animate'=> true,
            'clock' => 25,
            'respawn'=> true,
            'rotate'=> true,
            'modal'=> 'true'
        ), $atts );
    
        if( isset( $_COOKIE['tg-confetti'] )  && $a['modal'] == 'true' ){
            return;
        }else{
            setcookie( 'tg-confetti', 'has_shown', time() + 3600, COOKIEPATH, COOKIE_DOMAIN );
        }

        self::techgnosis_block_theme_scripts( $a );
        self::do_css();

        if( $a['modal'] == 'true' ){
            $el = "<div id=\"open-modal\" class=\"modal-window\"><div>";
            $el .= "<a href=\"#\" title=\"Close\" class=\"modal-close\"></a>";
            $el .= "<canvas id=\"techgnosis-canvas\"></canvas>";
            $el .= "<div id=\"confetti-content\">{$content}</div>";
            $el .= "</div></div>";
        }else{
            $el = "<div class=\"confetti-slide\">";
            $el .= "<canvas id=\"techgnosis-canvas\"></canvas>";
            $el .= "<div id=\"confetti-content\">{$content}</div>";
            $el .= "</div>";
        }

        return $el;
    }
    
    /**
     * Enqueue scripts and styles.
     */
    public static function techgnosis_block_theme_scripts( $options ) {
        $options = array_map( 'esc_html', $options);
        extract($options);

        wp_enqueue_script(
            'confetti',
            plugins_url( 'assets/confetti-js-master/dist/index.min.js', __FILE__ ),
            ['jquery'],
            '2',
            true
        );

        wp_register_script(
            'techg-confetti',
            plugins_url( 'assets/main.js', __FILE__ ),
            ['jquery','confetti'],
            '23',
            true
        );

        $colors = explode( '|', $colors );
        $colors = array_map( function( $color ){
            return explode( ',', $color );
        }, $colors);

        wp_localize_script( 'techg-confetti', 'tgObj', 
        [
            'popupDelay'=> $popupDelay,
            'shapes'=> explode( ',', $shapes ),
            'colors' => $colors,
            'svg' => $svg,
            'max'=> $max,
            'size'=> $size,
            'animate'=> $animate,
            'clock' => $clock,
            'respawn'=> $respawn,
            'modal'=>$modal,
            'rotate'=> $rotate
        ] );
        wp_enqueue_script( 'techg-confetti' );
        
    }

}