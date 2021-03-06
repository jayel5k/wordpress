<?php
/**
 * OnePress Theme Customizer.
 *
 * @package OnePress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepress_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer-controls.php';

	// Remove default sections.
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );

	// Custom WP default control & settings.
	$wp_customize->get_section( 'title_tagline' )->title = esc_html__('Site Title, Tagline & Logo', 'onepress');
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Hook to add other customize
	 */
	do_action( 'onepress_customize_before_register', $wp_customize );


	$pages  =  get_pages();
	$option_pages = array();
	$option_pages[0] = __( 'Select page', 'onepress' );
	foreach( $pages as $p ){
		$option_pages[ $p->ID ] = $p->post_title;
	}

	$users = get_users( array(
		'orderby'      => 'display_name',
		'order'        => 'ASC',
		'number'       => '',
	) );

	$option_users[0] = __( 'Select member', 'onepress' );
	foreach( $users as $user ){
		$option_users[ $user->ID ] = $user->display_name;
	}

	/*------------------------------------------------------------------------*/
    /*  Site Identity.
    /*------------------------------------------------------------------------*/
        /*
         * @deprecated 1.2.0
         */
        /*
    	$wp_customize->add_setting( 'onepress_site_image_logo',
			array(
				'sanitize_callback' => 'onepress_sanitize_file_url',
				'default'           => ''
			)
		);
    	$wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'onepress_site_image_logo',
				array(
					'label' 		=> esc_html__('Site Image Logo', 'onepress'),
					'section' 		=> 'title_tagline',
					'description'   => esc_html__('Your site image logo', 'onepress'),
				)
			)
		);
        */
        $is_old_logo = get_theme_mod( 'onepress_site_image_logo' );

        $wp_customize->add_setting( 'onepress_hide_sitetitle',
            array(
                'sanitize_callback' => 'onepress_sanitize_checkbox',
                'default'           => $is_old_logo ? 1: 0,
            )
        );
        $wp_customize->add_control(
            'onepress_hide_sitetitle',
            array(
                'label' 		=> esc_html__('Hide site title', 'onepress'),
                'section' 		=> 'title_tagline',
                'type'          => 'checkbox',
            )
        );

        $wp_customize->add_setting( 'onepress_hide_tagline',
            array(
                'sanitize_callback' => 'onepress_sanitize_checkbox',
                'default'           => $is_old_logo ? 1: 0,
            )
        );
        $wp_customize->add_control(
            'onepress_hide_tagline',
            array(
                'label' 		=> esc_html__('Hide site tagline', 'onepress'),
                'section' 		=> 'title_tagline',
                'type'          => 'checkbox',

            )
        );

	/*------------------------------------------------------------------------*/
    /*  Site Options
    /*------------------------------------------------------------------------*/
		$wp_customize->add_panel( 'onepress_options',
			array(
				'priority'       => 22,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Theme Options', 'onepress' ),
			    'description'    => '',
			)
		);

		/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'onepress_global_settings' ,
			array(
				'priority'    => 3,
				'title'       => esc_html__( 'Global', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_options',
			)
		);

			// Disable Sticky Header
			$wp_customize->add_setting( 'onepress_sticky_header_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'onepress_sticky_header_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Disable Sticky Header?', 'onepress'),
					'section'     => 'onepress_global_settings',
					'description' => esc_html__('Check this box to disable sticky header when scroll.', 'onepress')
				)
			);

			// Disable Animation
			$wp_customize->add_setting( 'onepress_animation_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'onepress_animation_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Disable animation effect?', 'onepress'),
					'section'     => 'onepress_global_settings',
					'description' => esc_html__('Check this box to disable all element animation when scroll.', 'onepress')
				)
			);

			// Disable Animation
			$wp_customize->add_setting( 'onepress_btt_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '',
					'transport'			=> 'postMessage'
				)
			);
			$wp_customize->add_control( 'onepress_btt_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide footer back to top?', 'onepress'),
					'section'     => 'onepress_global_settings',
					'description' => esc_html__('Check this box to hide footer back to top button.', 'onepress')
				)
			);

		/* Colors
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'onepress_colors_settings' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Site Colors', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_options',
			)
		);
			// Primary Color
			$wp_customize->add_setting( 'onepress_primary_color', array('sanitize_callback' => 'sanitize_hex_color_no_hash', 'sanitize_js_callback' => 'maybe_hash_hex_color', 'default' => '#03c4eb' ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_primary_color',
				array(
					'label'       => esc_html__( 'Primary Color', 'onepress' ),
					'section'     => 'onepress_colors_settings',
					'description' => '',
					'priority'    => 1
				)
			));

            // Footer BG Color
            $wp_customize->add_setting( 'onepress_footer_bg', array(
                'sanitize_callback' => 'sanitize_hex_color_no_hash',
                'sanitize_js_callback' => 'maybe_hash_hex_color',
                'default' => '',
                'transport' => 'postMessage'
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_footer_bg',
                array(
                    'label'       => esc_html__( 'Footer Background', 'onepress' ),
                    'section'     => 'onepress_colors_settings',
                    'description' => '',
                )
            ));

            // Footer Widgets Color
            $wp_customize->add_setting( 'onepress_footer_info_bg', array(
                'sanitize_callback' => 'sanitize_hex_color_no_hash',
                'sanitize_js_callback' => 'maybe_hash_hex_color',
                'default' => '',
                'transport' => 'postMessage'
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_footer_info_bg',
                array(
                    'label'       => esc_html__( 'Footer Info Background', 'onepress' ),
                    'section'     => 'onepress_colors_settings',
                    'description' => '',
                )
            ));




		/* Header
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'onepress_header_settings' ,
			array(
				'priority'    => 5,
				'title'       => esc_html__( 'Header', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_options',
			)
		);

		// Header BG Color
		$wp_customize->add_setting( 'onepress_header_bg_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_header_bg_color',
			array(
				'label'       => esc_html__( 'Background Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => '',
			)
		));


		// Site Title Color
		$wp_customize->add_setting( 'onepress_logo_text_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_logo_text_color',
			array(
				'label'       => esc_html__( 'Site Title Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => esc_html__( 'Only set if you don\'t use an image logo.', 'onepress' ),
			)
		));

		// Header Menu Color
		$wp_customize->add_setting( 'onepress_menu_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_menu_color',
			array(
				'label'       => esc_html__( 'Menu Link Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => '',
			)
		));

		// Header Menu Hover Color
		$wp_customize->add_setting( 'onepress_menu_hover_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_menu_hover_color',
			array(
				'label'       => esc_html__( 'Menu Link Hover/Active Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => '',

			)
		));

		// Header Menu Hover BG Color
		$wp_customize->add_setting( 'onepress_menu_hover_bg_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_menu_hover_bg_color',
			array(
				'label'       => esc_html__( 'Menu Link Hover/Active BG Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => '',
			)
		));

		// Reponsive Mobie button color
		$wp_customize->add_setting( 'onepress_menu_toggle_button_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'default' => ''
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'onepress_menu_toggle_button_color',
			array(
				'label'       => esc_html__( 'Responsive Menu Button Color', 'onepress' ),
				'section'     => 'onepress_header_settings',
				'description' => '',
			)
		));

		// Vertical align menu
		$wp_customize->add_setting( 'onepress_vertical_align_menu',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_vertical_align_menu',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Center vertical align for menu', 'onepress'),
				'section'     => 'onepress_header_settings',
				'description' => esc_html__('If you use logo and your logo is too tall, check this box to auto vertical align menu.', 'onepress')
			)
		);

		// Header Transparent
        $wp_customize->add_setting( 'onepress_header_transparent',
            array(
                'sanitize_callback' => 'onepress_sanitize_checkbox',
                'default'           => '',
                'active_callback'   => 'onepress_showon_frontpage'
            )
        );
        $wp_customize->add_control( 'onepress_header_transparent',
            array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Header Transparent', 'onepress'),
                'section'     => 'onepress_header_settings',
                'description' => esc_html__('Apply for front page template only.', 'onepress')
            )
        );

        $wp_customize->add_setting( 'onepress_header_scroll_logo',
            array(
                'sanitize_callback' => 'onepress_sanitize_checkbox',
                'default'           => 0,
                'active_callback'   => ''
            )
        );
        $wp_customize->add_control( 'onepress_header_scroll_logo',
            array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Scroll to top when click to home page on front page.', 'onepress'),
                'section'     => 'onepress_header_settings',
            )
        );

		/* Social Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'onepress_social' ,
			array(
				'priority'    => 6,
				'title'       => esc_html__( 'Social Profiles', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_options',
			)
		);

			// Disable Social
			$wp_customize->add_setting( 'onepress_social_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '1',
				)
			);
			$wp_customize->add_control( 'onepress_social_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide Footer Social?', 'onepress'),
					'section'     => 'onepress_social',
					'description' => esc_html__('Check this box to hide footer social section.', 'onepress')
				)
			);

			$wp_customize->add_setting( 'onepress_social_footer_guide',
				array(
					'sanitize_callback' => 'onepress_sanitize_text'
				)
			);
			$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_social_footer_guide',
				array(
					'section'     => 'onepress_social',
					'type'        => 'custom_message',
					'description' => esc_html__( 'These social profiles setting below will display at the footer of your site.', 'onepress' )
				)
			));

			// Footer Social Title
			$wp_customize->add_setting( 'onepress_social_footer_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Keep Updated', 'onepress' ),
					'transport'			=> 'postMessage',
				)
			);
			$wp_customize->add_control( 'onepress_social_footer_title',
				array(
					'label'       => esc_html__('Social Footer Title', 'onepress'),
					'section'     => 'onepress_social',
					'description' => ''
				)
			);

           // Socials
            $wp_customize->add_setting(
                'onepress_social_profiles',
                array(
                    //'default' => '',
                    'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
                    'transport' => 'postMessage', // refresh or postMessage
            ) );

            $wp_customize->add_control(
                new Onepress_Customize_Repeatable_Control(
                    $wp_customize,
                    'onepress_social_profiles',
                    array(
                        'label' 		=> esc_html__('Socials', 'onepress'),
                        'description'   => '',
                        'section'       => 'onepress_social',
                        'live_title_id' => 'network', // apply for unput text and textarea only
                        'title_format'  => esc_html__('[live_title]', 'onepress'), // [live_title]
                        'max_item'      => 5, // Maximum item can add
                        'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
                        'fields'    => array(
                            'network'  => array(
                                'title' => esc_html__('Social network', 'onepress'),
                                'type'  =>'text',
                            ),
                            'icon'  => array(
                                'title' => esc_html__('Icon', 'onepress'),
                                'desc' => __('Paste your <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a> icon class name here.', 'onepress'),
                                'type'  =>'text',
                            ),
                            'link'  => array(
                                'title' => esc_html__('URL', 'onepress'),
                                'type'  =>'text',
                            ),
                        ),

                    )
                )
            );

		/* Newsletter Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'onepress_newsletter' ,
			array(
				'priority'    => 9,
				'title'       => esc_html__( 'Newsletter', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_options',
			)
		);
			// Disable Newsletter
			$wp_customize->add_setting( 'onepress_newsletter_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '1',
				)
			);
			$wp_customize->add_control( 'onepress_newsletter_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide Footer Newsletter?', 'onepress'),
					'section'     => 'onepress_newsletter',
					'description' => esc_html__('Check this box to hide footer newsletter form.', 'onepress')
				)
			);

			// Mailchimp Form Title
			$wp_customize->add_setting( 'onepress_newsletter_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Join our Newsletter', 'onepress' ),
                    'transport'         => 'postMessage', // refresh or postMessage
				)
			);
			$wp_customize->add_control( 'onepress_newsletter_title',
				array(
					'label'       => esc_html__('Newsletter Form Title', 'onepress'),
					'section'     => 'onepress_newsletter',
					'description' => ''
				)
			);

			// Mailchimp action url
			$wp_customize->add_setting( 'onepress_newsletter_mailchimp',
				array(
					'sanitize_callback' => 'esc_url',
					'default'           => '',
                    'transport'         => 'postMessage', // refresh or postMessage
				)
			);
			$wp_customize->add_control( 'onepress_newsletter_mailchimp',
				array(
					'label'       => esc_html__('MailChimp Action URL', 'onepress'),
					'section'     => 'onepress_newsletter',
					'description' => __( 'The newsletter form use MailChimp, please follow <a target="_blank" href="http://goo.gl/uRVIst">this guide</a> to know how to get MailChimp Action URL. Example <i>//famethemes.us8.list-manage.com/subscribe/post?u=521c400d049a59a4b9c0550c2&amp;id=83187e0006</i>', 'onepress' )
				)
			);

			/* Hero options
			----------------------------------------------------------------------*/
			$wp_customize->add_section(
				'onepress_hero_options',
				array(
					'title'       => __( 'Hero Options', 'onepress' ),
					'panel'       => 'onepress_options',
				)
			);


			$wp_customize->add_setting(
				'onepress_hero_option_animation',
				array(
					'default'              => 'flipInX',
					'sanitize_callback'    => 'sanitize_text_field',
				)
			);

			/**
			 * @see https://github.com/daneden/animate.css
			 */

			$animations_css = 'bounce flash pulse rubberBand shake headShake swing tada wobble jello bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipInX flipInY flipOutX flipOutY lightSpeedIn lightSpeedOut rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight hinge rollIn rollOut zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp slideInDown slideInLeft slideInRight slideInUp slideOutDown slideOutLeft slideOutRight slideOutUp';

			$animations_css = explode( ' ', $animations_css );
			$animations = array();
			foreach ( $animations_css as $v ) {
				$v =  trim( $v );
				if ( $v ){
					$animations[ $v ]= $v;
				}

			}

			$wp_customize->add_control(
				'onepress_hero_option_animation',
				array(
					'label'    => __( 'Text animation', 'onepress' ),
					'section'  => 'onepress_hero_options',
					'type'     => 'select',
					'choices' => $animations,
				)
			);


			$wp_customize->add_setting(
				'onepress_hero_option_speed',
				array(
					'default'              => '5000',
					'sanitize_callback'    => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				'onepress_hero_option_speed',
				array(
					'label'    => __( 'Speed', 'onepress' ),
					'description' => esc_html__( 'The delay between the changing of each phrase in milliseconds.', 'onepress' ),
					'section'  => 'onepress_hero_options',
				)
			);


			/* Custom CSS Settings
			----------------------------------------------------------------------*/
			$wp_customize->add_section(
				'onepress_custom_code',
				array(
					'title'       => __( 'Custom CSS', 'onepress' ),
					'panel'       => 'onepress_options',
				)
			);


			$wp_customize->add_setting(
				'onepress_custom_css',
				array(
					'default'              => '',
					'sanitize_callback'    => 'onepress_sanitize_css',
					'type' 				   => 'option',
				)
			);

			$wp_customize->add_control(
				'onepress_custom_css',
				array(
					'label'    => __( 'Custom CSS', 'onepress' ),
					'section'  => 'onepress_custom_code',
					'type'     => 'textarea'
				)
			);


	/*------------------------------------------------------------------------*/
    /*  Section: Order & Styling
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'onepress_order_styling' ,
		array(
			'priority'        => 129,
			'title'           => esc_html__( 'Section Order & Styling', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);
		// Plus message
		$wp_customize->add_setting( 'onepress_order_styling_message',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
			)
		);
		$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_order_styling_message',
			array(
				'section'     => 'onepress_news_settings',
				'type'        => 'custom_message',
				'section'     => 'onepress_order_styling',
				'description' => wp_kses_post( 'Check out <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus version</a> for full control over <strong>section order</strong> and <strong>section styling</strong>! ', 'onepress' )
			)
		));


	/*------------------------------------------------------------------------*/
    /*  Section: Hero
    /*------------------------------------------------------------------------*/

	$wp_customize->add_panel( 'onepress_hero_panel' ,
		array(
			'priority'        => 130,
			'title'           => esc_html__( 'Section: Hero', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

		// Hero settings
		$wp_customize->add_section( 'onepress_hero_settings' ,
			array(
				'priority'    => 3,
				'title'       => esc_html__( 'Hero Settings', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_hero_panel',
			)
		);

			// Show section
			$wp_customize->add_setting( 'onepress_hero_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'onepress_hero_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide this section?', 'onepress'),
					'section'     => 'onepress_hero_settings',
					'description' => esc_html__('Check this box to hide this section.', 'onepress'),
				)
			);
			// Section ID
			$wp_customize->add_setting( 'onepress_hero_id',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
					'default'           => esc_html__('hero', 'onepress'),
				)
			);
			$wp_customize->add_control( 'onepress_hero_id',
				array(
					'label' 		=> esc_html__('Section ID:', 'onepress'),
					'section' 		=> 'onepress_hero_settings',
					'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
				)
			);

			// Show hero full screen
			$wp_customize->add_setting( 'onepress_hero_fullscreen',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'onepress_hero_fullscreen',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Make hero section full screen', 'onepress'),
					'section'     => 'onepress_hero_settings',
					'description' => esc_html__('Check this box to make hero section full screen.', 'onepress'),
				)
			);

			// Hero content padding top
			$wp_customize->add_setting( 'onepress_hero_pdtop',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
					'default'           => esc_html__('10', 'onepress'),
				)
			);
			$wp_customize->add_control( 'onepress_hero_pdtop',
				array(
					'label'           => esc_html__('Padding Top:', 'onepress'),
					'section'         => 'onepress_hero_settings',
					'description'     => esc_html__( 'The hero content padding top in percent (%).', 'onepress' ),
					'active_callback' => 'onepress_hero_fullscreen_callback'
				)
			);

			// Hero content padding bottom
			$wp_customize->add_setting( 'onepress_hero_pdbotom',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
					'default'           => esc_html__('10', 'onepress'),
				)
			);
			$wp_customize->add_control( 'onepress_hero_pdbotom',
				array(
					'label'           => esc_html__('Padding Bottom:', 'onepress'),
					'section'         => 'onepress_hero_settings',
					'description'     => esc_html__( 'The hero content padding bottom in percent (%).', 'onepress' ),
					'active_callback' => 'onepress_hero_fullscreen_callback'
				)
			);

		$wp_customize->add_section( 'onepress_hero_images' ,
			array(
				'priority'    => 6,
				'title'       => esc_html__( 'Hero Background Media', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_hero_panel',
			)
		);

			$wp_customize->add_setting(
				'onepress_hero_images',
				array(
					'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
					'transport' => 'refresh', // refresh or postMessage
					'default' => json_encode( array(
						array(
							'image'=> array(
								'url' => get_template_directory_uri().'/assets/images/hero5.jpg',
								'id' => ''
							)
						)
					) )
				) );

			$wp_customize->add_control(
				new Onepress_Customize_Repeatable_Control(
					$wp_customize,
					'onepress_hero_images',
					array(
						'label'     => esc_html__('Background Images', 'onepress'),
						'description'   => '',
						'priority'     => 40,
						'section'       => 'onepress_hero_images',
						'title_format'  => esc_html__( 'Background', 'onepress'), // [live_title]
						'max_item'      => 2, // Maximum item can add

						'fields'    => array(
							'image' => array(
								'title' => esc_html__('Background Image', 'onepress'),
								'type'  =>'media',
								'default' => array(
									'url' => get_template_directory_uri().'/assets/images/hero5.jpg',
									'id' => ''
								)
							),

						),

					)
				)
			);

			// Overlay color
			$wp_customize->add_setting( 'onepress_hero_overlay_color',
				array(
					'sanitize_callback' => 'onepress_sanitize_color_alpha',
					'default'           => 'rgba(0,0,0,.3)',
					'transport' => 'refresh', // refresh or postMessage
				)
			);
			$wp_customize->add_control( new OnePress_Alpha_Color_Control(
					$wp_customize,
					'onepress_hero_overlay_color',
					array(
						'label' 		=> esc_html__('Background Overlay Color', 'onepress'),
						'section' 		=> 'onepress_hero_images',
						'priority'      => 130,
					)
				)
			);


            // Parallax
            $wp_customize->add_setting( 'onepress_hero_parallax',
                array(
                    'sanitize_callback' => 'onepress_sanitize_checkbox',
                    'default'           => 0,
                    'transport' => 'refresh', // refresh or postMessage
                )
            );
            $wp_customize->add_control(
                'onepress_hero_parallax',
                array(
                    'label' 		=> esc_html__('Enable parallax effect (apply for first BG image only)', 'onepress'),
                    'section' 		=> 'onepress_hero_images',
                    'type' 		   => 'checkbox',
                    'priority'      => 50,
                    'description' => '',
                )
            );

			// Overlay Opacity
			/*
			$wp_customize->add_setting( 'onepress_hero_overlay_opacity',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => '0.3',
					'transport' => 'refresh', // refresh or postMessage
				)
			);
			$wp_customize->add_control(
					'onepress_hero_overlay_opacity',
					array(
						'label' 		=> esc_html__('Background Overlay Opacity', 'onepress'),
						'section' 		=> 'onepress_hero_images',
						'description'   => esc_html__('Enter a float number between 0.1 to 0.9', 'onepress'),
						'priority'      => 130,
					)
			);
			*/

			// Background Video
			$wp_customize->add_setting( 'onepress_hero_videobackground_upsell',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
				)
			);
			$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_hero_videobackground_upsell',
				array(
					'section'     => 'onepress_hero_images',
					'type'        => 'custom_message',
					'description' => wp_kses_post( 'Want to add <strong>background video</strong> for hero section? Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> version.', 'onepress' ),
					'priority'    => 131,
				)
			));



		$wp_customize->add_section( 'onepress_hero_content_layout1' ,
			array(
				'priority'    => 9,
				'title'       => esc_html__( 'Hero Content Layout', 'onepress' ),
				'description' => '',
				'panel'       => 'onepress_hero_panel',

			)
		);

			// Hero Layout
			$wp_customize->add_setting( 'onepress_hero_layout',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
					'default'           => '1',
				)
			);
			$wp_customize->add_control( 'onepress_hero_layout',
				array(
					'label' 		=> esc_html__('Display Layout', 'onepress'),
					'section' 		=> 'onepress_hero_content_layout1',
					'description'   => '',
					'type'          => 'select',
					'choices'       => array(
						'1' => esc_html__('Layout 1', 'onepress' ),
						'2' => esc_html__('Layout 2', 'onepress' ),
					),
				)
			);
			// For Hero layout ------------------------

				// Large Text
				$wp_customize->add_setting( 'onepress_hcl1_largetext',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'mod' 				=> 'html',
						'default'           => wp_kses_post('We are <span class="js-rotating">OnePress | One Page | Responsive | Perfection</span>', 'onepress'),
					)
				);
				$wp_customize->add_control( new OnePress_Editor_Custom_Control(
					$wp_customize,
					'onepress_hcl1_largetext',
					array(
						'label' 		=> esc_html__('Large Text', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1',
						'description'   => esc_html__('Text Rotating Guide: Put your rotate texts separate by "|" into <span class="js-rotating">...</span>, go to Customizer->Site Option->Animate to control rotate animation.', 'onepress'),
					)
				));

				// Small Text
				$wp_customize->add_setting( 'onepress_hcl1_smalltext',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'default'			=> wp_kses_post('Morbi tempus porta nunc <strong>pharetra quisque</strong> ligula imperdiet posuere<br> vitae felis proin sagittis leo ac tellus blandit sollicitudin quisque vitae placerat.', 'onepress'),
					)
				);
				$wp_customize->add_control( new OnePress_Editor_Custom_Control(
					$wp_customize,
					'onepress_hcl1_smalltext',
					array(
						'label' 		=> esc_html__('Small Text', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1',
						'mod' 				=> 'html',
						'description'   => esc_html__('You can use text rotate slider in this textarea too.', 'onepress'),
					)
				));

				// Button #1 Text
				$wp_customize->add_setting( 'onepress_hcl1_btn1_text',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'default'           => esc_html__('About Us', 'onepress'),
					)
				);
				$wp_customize->add_control( 'onepress_hcl1_btn1_text',
					array(
						'label' 		=> esc_html__('Button #1 Text', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1'
					)
				);

				// Button #1 Link
				$wp_customize->add_setting( 'onepress_hcl1_btn1_link',
					array(
						'sanitize_callback' => 'esc_url',
						'default'           => esc_url( home_url( '/' )).esc_html__('#about', 'onepress'),
					)
				);
				$wp_customize->add_control( 'onepress_hcl1_btn1_link',
					array(
						'label' 		=> esc_html__('Button #1 Link', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1'
					)
				);
                // Button #1 Style
				$wp_customize->add_setting( 'onepress_hcl1_btn1_style',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'default'           => 'btn-theme-primary',
					)
				);
				$wp_customize->add_control( 'onepress_hcl1_btn1_style',
					array(
						'label' 		=> esc_html__('Button #1 style', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1',
                        'type'          => 'select',
                        'choices' => array(
                                'btn-theme-primary' => esc_html__('Button Primary', 'onepress'),
                                'btn-secondary-outline' => esc_html__('Button Secondary', 'onepress'),
                                'btn-default' => esc_html__('Button', 'onepress'),
                                'btn-primary' => esc_html__('Primary', 'onepress'),
                                'btn-success' => esc_html__('Success', 'onepress'),
                                'btn-info' => esc_html__('Info', 'onepress'),
                                'btn-warning' => esc_html__('Warning', 'onepress'),
                                'btn-danger' => esc_html__('Danger', 'onepress'),
                        )
					)
				);

				// Button #2 Text
				$wp_customize->add_setting( 'onepress_hcl1_btn2_text',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'default'           => esc_html__('Get Started', 'onepress'),
					)
				);
				$wp_customize->add_control( 'onepress_hcl1_btn2_text',
					array(
						'label' 		=> esc_html__('Button #2 Text', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1'
					)
				);

				// Button #2 Link
				$wp_customize->add_setting( 'onepress_hcl1_btn2_link',
					array(
						'sanitize_callback' => 'esc_url',
						'default'           => esc_url( home_url( '/' )).esc_html__('#contact', 'onepress'),
					)
				);
				$wp_customize->add_control( 'onepress_hcl1_btn2_link',
					array(
						'label' 		=> esc_html__('Button #2 Link', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1'
					)
				);

                // Button #1 Style
                $wp_customize->add_setting( 'onepress_hcl1_btn2_style',
                    array(
                        'sanitize_callback' => 'onepress_sanitize_text',
                        'default'           => 'btn-secondary-outline',
                    )
                );
                $wp_customize->add_control( 'onepress_hcl1_btn2_style',
                    array(
                        'label' 		=> esc_html__('Button #2 style', 'onepress'),
                        'section' 		=> 'onepress_hero_content_layout1',
                        'type'          => 'select',
                        'choices' => array(
                            'btn-theme-primary' => esc_html__('Button Primary', 'onepress'),
                            'btn-secondary-outline' => esc_html__('Button Secondary', 'onepress'),
                            'btn-default' => esc_html__('Button', 'onepress'),
                            'btn-primary' => esc_html__('Primary', 'onepress'),
                            'btn-success' => esc_html__('Success', 'onepress'),
                            'btn-info' => esc_html__('Info', 'onepress'),
                            'btn-warning' => esc_html__('Warning', 'onepress'),
                            'btn-danger' => esc_html__('Danger', 'onepress'),
                        )
                    )
                );


				/* Layout 2 ---- */

				// Layout 22 content text
				$wp_customize->add_setting( 'onepress_hcl2_content',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'mod' 				=> 'html',
						'default'           =>  wp_kses_post( '<h1>Business Website'."\n".'Made Simple.</h1>'."\n".'We provide creative solutions to clients around the world,'."\n".'creating things that get attention and meaningful.'."\n\n".'<a class="btn btn-secondary-outline btn-lg" href="#">Get Started</a>' ),
					)
				);
				$wp_customize->add_control( new OnePress_Editor_Custom_Control(
					$wp_customize,
					'onepress_hcl2_content',
					array(
						'label' 		=> esc_html__('Content Text', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1',
						'description'   => '',
					)
				));

				// Layout 2 image
				$wp_customize->add_setting( 'onepress_hcl2_image',
					array(
						'sanitize_callback' => 'onepress_sanitize_text',
						'mod' 				=> 'html',
						'default'           =>  get_template_directory_uri().'/assets/images/onepress_responsive.png',
					)
				);
				$wp_customize->add_control( new WP_Customize_Image_Control(
					$wp_customize,
					'onepress_hcl2_image',
					array(
						'label' 		=> esc_html__('Image', 'onepress'),
						'section' 		=> 'onepress_hero_content_layout1',
						'description'   => '',
					)
				));


			// END For Hero layout ------------------------

	/*------------------------------------------------------------------------*/
	/*  Section: Video Popup
	/*------------------------------------------------------------------------*/
	$wp_customize->add_panel( 'onepress_videolightbox' ,
		array(
			'priority'        => 132,
			'title'           => esc_html__( 'Section: Video Lightbox', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

    $wp_customize->add_section( 'onepress_videolightbox_settings' ,
        array(
            'priority'    => 3,
            'title'       => esc_html__( 'Section Settings', 'onepress' ),
            'description' => '',
            'panel'       => 'onepress_videolightbox',
        )
    );

    // Show Content
    $wp_customize->add_setting( 'onepress_videolightbox_disable',
        array(
            'sanitize_callback' => 'onepress_sanitize_checkbox',
            'default'           => '',
        )
    );
    $wp_customize->add_control( 'onepress_videolightbox_disable',
        array(
            'type'        => 'checkbox',
            'label'       => esc_html__('Hide this section?', 'onepress'),
            'section'     => 'onepress_videolightbox_settings',
            'description' => esc_html__('Check this box to hide this section.', 'onepress'),
        )
    );

    // Section ID
    $wp_customize->add_setting( 'onepress_videolightbox_id',
        array(
            'sanitize_callback' => 'onepress_sanitize_text',
            'default'           => 'videolightbox',
        )
    );
    $wp_customize->add_control( 'onepress_videolightbox_id',
        array(
            'label' 		=> esc_html__('Section ID:', 'onepress'),
            'section' 		=> 'onepress_videolightbox_settings',
            'description'   => esc_html__('The section id, we will use this for link anchor.', 'onepress' )
        )
    );

    // Title
    $wp_customize->add_setting( 'onepress_videolightbox_title',
        array(
            'sanitize_callback' => 'onepress_sanitize_text',
            'default'           => '',
        )
    );

    $wp_customize->add_control( new OnePress_Editor_Custom_Control(
        $wp_customize,
        'onepress_videolightbox_title',
        array(
            'label'     	=>  esc_html__('Section heading', 'onepress'),
            'section' 		=> 'onepress_videolightbox_settings',
            'description'   => '',
        )
    ));

    // Video URL
    $wp_customize->add_setting( 'onepress_videolightbox_url',
        array(
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
        )
    );
    $wp_customize->add_control( 'onepress_videolightbox_url',
        array(
            'label' 		=> esc_html__('Video url', 'onepress'),
            'section' 		=> 'onepress_videolightbox_settings',
            'description'   =>  esc_html__('Paste Youtube or Vimeo url here', 'onepress'),
        )
    );

    // Parallax image
    $wp_customize->add_setting( 'onepress_videolightbox_image',
        array(
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'onepress_videolightbox_image',
        array(
            'label' 		=> esc_html__('Background image', 'onepress'),
            'section' 		=> 'onepress_videolightbox_settings',
        )
    ));



	/*------------------------------------------------------------------------*/
    /*  Section: About
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_about' ,
		array(
			'priority'        => 132,
			'title'           => esc_html__( 'Section: About', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_about_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_about',
		)
	);

		// Show Content
		$wp_customize->add_setting( 'onepress_about_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_about_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_about_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);

		// Section ID
		$wp_customize->add_setting( 'onepress_about_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('about', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_about_id',
			array(
				'label' 		=> esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_about_settings',
				'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_about_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('About Us', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_about_title',
			array(
				'label' 		=> esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_about_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_about_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_about_subtitle',
			array(
				'label' 		=> esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_about_settings',
				'description'   => '',
			)
		);

		// Description
		$wp_customize->add_setting( 'onepress_about_desc',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( new OnePress_Editor_Custom_Control(
			$wp_customize,
			'onepress_about_desc',
			array(
				'label' 		=> esc_html__('Section Description', 'onepress'),
				'section' 		=> 'onepress_about_settings',
				'description'   => '',
			)
		));


	$wp_customize->add_section( 'onepress_about_content' ,
		array(
			'priority'    => 6,
			'title'       => esc_html__( 'Section Content', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_about',
		)
	);

		// Order & Stlying
		$wp_customize->add_setting(
			'onepress_about_boxes',
			array(
				//'default' => '',
				'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
				'transport' => 'refresh', // refresh or postMessage
			) );


			$wp_customize->add_control(
				new Onepress_Customize_Repeatable_Control(
					$wp_customize,
					'onepress_about_boxes',
					array(
						'label' 		=> esc_html__('About content page', 'onepress'),
						'description'   => '',
						'section'       => 'onepress_about_content',
						'live_title_id' => 'content_page', // apply for unput text and textarea only
						'title_format'  => esc_html__('[live_title]', 'onepress'), // [live_title]
						'max_item'      => 3, // Maximum item can add
                        'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
						//'allow_unlimited' => false, // Maximum item can add

						'fields'    => array(
							'content_page'  => array(
								'title' => esc_html__('Select a page', 'onepress'),
								'type'  =>'select',
								'options' => $option_pages
							),
							'hide_title'  => array(
								'title' => esc_html__('Hide item title', 'onepress'),
								'type'  =>'checkbox',
							),
							'enable_link'  => array(
								'title' => esc_html__('Link to single page', 'onepress'),
								'type'  =>'checkbox',
							),
						),

					)
				)
			);

            // About content source
            $wp_customize->add_setting( 'onepress_about_content_source',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 'content',
                )
            );

            $wp_customize->add_control( 'onepress_about_content_source',
                array(
                    'label' 		=> esc_html__('Item content source', 'onepress'),
                    'section' 		=> 'onepress_about_content',
                    'description'   => '',
                    'type'          => 'select',
                    'choices'       => array(
                        'content' => esc_html__( 'Full Page Content', 'onepress' ),
                        'excerpt' => esc_html__( 'Page Excerpt', 'onepress' ),
                    ),
                )
            );


    /*------------------------------------------------------------------------*/
    /*  Section: Features
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_features' ,
        array(
            'priority'        => 134,
            'title'           => esc_html__( 'Section: Features', 'onepress' ),
            'description'     => '',
            'active_callback' => 'onepress_showon_frontpage'
        )
    );

    $wp_customize->add_section( 'onepress_features_settings' ,
        array(
            'priority'    => 3,
            'title'       => esc_html__( 'Section Settings', 'onepress' ),
            'description' => '',
            'panel'       => 'onepress_features',
        )
    );

    // Show Content
    $wp_customize->add_setting( 'onepress_features_disable',
        array(
            'sanitize_callback' => 'onepress_sanitize_checkbox',
            'default'           => '',
        )
    );
    $wp_customize->add_control( 'onepress_features_disable',
        array(
            'type'        => 'checkbox',
            'label'       => esc_html__('Hide this section?', 'onepress'),
            'section'     => 'onepress_features_settings',
            'description' => esc_html__('Check this box to hide this section.', 'onepress'),
        )
    );

    // Section ID
    $wp_customize->add_setting( 'onepress_features_id',
        array(
            'sanitize_callback' => 'onepress_sanitize_text',
            'default'           => esc_html__('features', 'onepress'),
        )
    );
    $wp_customize->add_control( 'onepress_features_id',
        array(
            'label' 		=> esc_html__('Section ID:', 'onepress'),
            'section' 		=> 'onepress_features_settings',
            'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
        )
    );

    // Title
    $wp_customize->add_setting( 'onepress_features_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => esc_html__('Features', 'onepress'),
        )
    );
    $wp_customize->add_control( 'onepress_features_title',
        array(
            'label' 		=> esc_html__('Section Title', 'onepress'),
            'section' 		=> 'onepress_features_settings',
            'description'   => '',
        )
    );

    // Sub Title
    $wp_customize->add_setting( 'onepress_features_subtitle',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => esc_html__('Section subtitle', 'onepress'),
        )
    );
    $wp_customize->add_control( 'onepress_features_subtitle',
        array(
            'label' 		=> esc_html__('Section Subtitle', 'onepress'),
            'section' 		=> 'onepress_features_settings',
            'description'   => '',
        )
    );

    // Description
    $wp_customize->add_setting( 'onepress_features_desc',
        array(
            'sanitize_callback' => 'onepress_sanitize_text',
            'default'           => '',
        )
    );
    $wp_customize->add_control( new OnePress_Editor_Custom_Control(
        $wp_customize,
        'onepress_features_desc',
        array(
            'label' 		=> esc_html__('Section Description', 'onepress'),
            'section' 		=> 'onepress_features_settings',
            'description'   => '',
        )
    ));

    // Features layout
    $wp_customize->add_setting( 'onepress_features_layout',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '3',
        )
    );

    $wp_customize->add_control( 'onepress_features_layout',
        array(
            'label' 		=> esc_html__('Features Layout Setting', 'onepress'),
            'section' 		=> 'onepress_features_settings',
            'description'   => '',
            'type'          => 'select',
            'choices'       => array(
                '3' => esc_html__( '4 Columns', 'onepress' ),
                '4' => esc_html__( '3 Columns', 'onepress' ),
                '6' => esc_html__( '2 Columns', 'onepress' ),
            ),
        )
    );


    $wp_customize->add_section( 'onepress_features_content' ,
        array(
            'priority'    => 6,
            'title'       => esc_html__( 'Section Content', 'onepress' ),
            'description' => '',
            'panel'       => 'onepress_features',
        )
    );

    // Order & Styling
    $wp_customize->add_setting(
        'onepress_features_boxes',
        array(
            //'default' => '',
            'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
            'transport' => 'refresh', // refresh or postMessage
        ) );

    $wp_customize->add_control(
        new Onepress_Customize_Repeatable_Control(
            $wp_customize,
            'onepress_features_boxes',
            array(
                'label' 		=> esc_html__('Features content', 'onepress'),
                'description'   => '',
                'section'       => 'onepress_features_content',
                'live_title_id' => 'title', // apply for unput text and textarea only
                'title_format'  => esc_html__('[live_title]', 'onepress'), // [live_title]
                'max_item'      => 4, // Maximum item can add
                'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
                'fields'    => array(
                    'title'  => array(
                        'title' => esc_html__('Title', 'onepress'),
                        'type'  =>'text',
                    ),
					'icon_type'  => array(
						'title' => esc_html__('Custom icon', 'onepress'),
						'desc' => __('Paste your <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a> icon class name here.', 'onepress'),
						'type'  =>'select',
						'options' => array(
							'icon' => esc_html__('Icon', 'onepress'),
							'image' => esc_html__('image', 'onepress'),
						),
					),
                    'icon'  => array(
                        'title' => esc_html__('Icon', 'onepress'),
                        'desc' => __('Paste your <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a> icon class name here.', 'onepress'),
                        'type'  =>'text',
						'required' => array( 'icon_type', '=', 'icon' ),
                    ),
					'image'  => array(
						'title' => esc_html__('Image', 'onepress'),
						'type'  =>'media',
						'required' => array( 'icon_type', '=', 'image' ),
					),
                    'desc'  => array(
                        'title' => esc_html__('Description', 'onepress'),
                        'type'  =>'editor',
                    ),
                    'link'  => array(
                        'title' => esc_html__('Custom Link', 'onepress'),
                        'type'  =>'text',
                    ),
                ),

            )
        )
    );

    // About content source
    $wp_customize->add_setting( 'onepress_about_content_source',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => 'content',
        )
    );

    $wp_customize->add_control( 'onepress_about_content_source',
        array(
            'label' 		=> esc_html__('Item content source', 'onepress'),
            'section' 		=> 'onepress_about_content',
            'description'   => '',
            'type'          => 'select',
            'choices'       => array(
                'content' => esc_html__( 'Full Page Content', 'onepress' ),
                'excerpt' => esc_html__( 'Page Excerpt', 'onepress' ),
            ),
        )
    );



    /*------------------------------------------------------------------------*/
    /*  Section: Services
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_services' ,
		array(
			'priority'        => 134,
			'title'           => esc_html__( 'Section: Services', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_service_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_services',
		)
	);

		// Show Content
		$wp_customize->add_setting( 'onepress_services_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_services_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_service_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);

		// Section ID
		$wp_customize->add_setting( 'onepress_services_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('services', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_services_id',
			array(
				'label'     => esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_service_settings',
				'description'   => 'The section id, we will use this for link anchor.'
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_services_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Our Services', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_services_title',
			array(
				'label'     => esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_service_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_services_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_services_subtitle',
			array(
				'label'     => esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_service_settings',
				'description'   => '',
			)
		);

        // Description
        $wp_customize->add_setting( 'onepress_services_desc',
            array(
                'sanitize_callback' => 'onepress_sanitize_text',
                'default'           => '',
            )
        );
        $wp_customize->add_control( new OnePress_Editor_Custom_Control(
            $wp_customize,
            'onepress_services_desc',
            array(
                'label' 		=> esc_html__('Section Description', 'onepress'),
                'section' 		=> 'onepress_service_settings',
                'description'   => '',
            )
        ));


        // Services layout
        $wp_customize->add_setting( 'onepress_service_layout',
            array(
                'sanitize_callback' => 'sanitize_text_field',
                'default'           => '6',
            )
        );

        $wp_customize->add_control( 'onepress_service_layout',
            array(
                'label' 		=> esc_html__('Services Layout Setting', 'onepress'),
                'section' 		=> 'onepress_service_settings',
                'description'   => '',
                'type'          => 'select',
                'choices'       => array(
                    '3' => esc_html__( '4 Columns', 'onepress' ),
                    '4' => esc_html__( '3 Columns', 'onepress' ),
                    '6' => esc_html__( '2 Columns', 'onepress' ),
                ),
            )
        );


	$wp_customize->add_section( 'onepress_service_content' ,
		array(
			'priority'    => 6,
			'title'       => esc_html__( 'Section Content', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_services',
		)
	);

		// Section service content.
		$wp_customize->add_setting(
			'onepress_services',
			array(
				'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
				'transport' => 'refresh', // refresh or postMessage
			) );


		$wp_customize->add_control(
			new Onepress_Customize_Repeatable_Control(
				$wp_customize,
				'onepress_services',
				array(
					'label'     	=> esc_html__('Service content', 'onepress'),
					'description'   => '',
					'section'       => 'onepress_service_content',
					'live_title_id' => 'content_page', // apply for unput text and textarea only
					'title_format'  => esc_html__('[live_title]', 'onepress'), // [live_title]
					'max_item'      => 4, // Maximum item can add
                    'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),

					'fields'    => array(
						'icon_type'  => array(
							'title' => esc_html__('Custom icon', 'onepress'),
							'desc' => __('Paste your <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a> icon class name here.', 'onepress'),
							'type'  =>'select',
							'options' => array(
								'icon' => esc_html__('Icon', 'onepress'),
								'image' => esc_html__('image', 'onepress'),
							),
						),
						'icon'  => array(
							'title' => esc_html__('Icon', 'onepress'),
							'desc' => __('Paste your <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a> icon class name here.', 'onepress'),
							'type'  =>'text',
							'required' => array( 'icon_type', '=', 'icon' ),
						),
						'image'  => array(
							'title' => esc_html__('Image', 'onepress'),
							'type'  =>'media',
							'required' => array( 'icon_type', '=', 'image' ),
						),

						'content_page'  => array(
							'title' => esc_html__('Select a page', 'onepress'),
							'type'  =>'select',
							'options' => $option_pages
						),
						'enable_link'  => array(
							'title' => esc_html__('Link to single page', 'onepress'),
							'type'  =>'checkbox',
						),
					),

				)
			)
		);

	/*------------------------------------------------------------------------*/
    /*  Section: Counter
    /*------------------------------------------------------------------------*/
	$wp_customize->add_panel( 'onepress_counter' ,
		array(
			'priority'        => 134,
			'title'           => esc_html__( 'Section: Counter', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_counter_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_counter',
		)
	);
		// Show Content
		$wp_customize->add_setting( 'onepress_counter_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_counter_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_counter_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);

		// Section ID
		$wp_customize->add_setting( 'onepress_counter_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('counter', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_counter_id',
			array(
				'label'     	=> esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_counter_settings',
				'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_counter_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Our Numbers', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_counter_title',
			array(
				'label'     	=> esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_counter_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_counter_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_counter_subtitle',
			array(
				'label'     	=> esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_counter_settings',
				'description'   => '',
			)
		);

        // Description
        $wp_customize->add_setting( 'onepress_counter_desc',
            array(
                'sanitize_callback' => 'onepress_sanitize_text',
                'default'           => '',
            )
        );
        $wp_customize->add_control( new OnePress_Editor_Custom_Control(
            $wp_customize,
            'onepress_counter_desc',
            array(
                'label' 		=> esc_html__('Section Description', 'onepress'),
                'section' 		=> 'onepress_counter_settings',
                'description'   => '',
            )
        ));

	$wp_customize->add_section( 'onepress_counter_content' ,
		array(
			'priority'    => 6,
			'title'       => esc_html__( 'Section Content', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_counter',
		)
	);

	// Order & Styling
	$wp_customize->add_setting(
		'onepress_counter_boxes',
		array(
			'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
			'transport' => 'refresh', // refresh or postMessage
		) );


		$wp_customize->add_control(
			new Onepress_Customize_Repeatable_Control(
				$wp_customize,
				'onepress_counter_boxes',
				array(
					'label'     	=> esc_html__('Counter content', 'onepress'),
					'description'   => '',
					'section'       => 'onepress_counter_content',
					'live_title_id' => 'title', // apply for unput text and textarea only
					'title_format'  => esc_html__('[live_title]', 'onepress'), // [live_title]
					'max_item'      => 4, // Maximum item can add
                    'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
                    'fields'    => array(
						'title' => array(
							'title' => esc_html__('Title', 'onepress'),
							'type'  =>'text',
							'desc'  => '',
							'default' => esc_html__( 'Your counter label', 'onepress' ),
						),
						'number' => array(
							'title' => esc_html__('Number', 'onepress'),
							'type'  =>'text',
							'default' => 99,
						),
						'unit_before'  => array(
							'title' => esc_html__('Before number', 'onepress'),
							'type'  =>'text',
							'default' => '',
						),
						'unit_after'  => array(
							'title' => esc_html__('After number', 'onepress'),
							'type'  =>'text',
							'default' => '',
						),
					),

				)
			)
		);

	/*------------------------------------------------------------------------*/
    /*  Section: Team
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_team' ,
		array(
			'priority'        => 136,
			'title'           => esc_html__( 'Section: Team', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_team_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_team',
		)
	);

		// Show Content
		$wp_customize->add_setting( 'onepress_team_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_team_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_team_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);
		// Section ID
		$wp_customize->add_setting( 'onepress_team_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('team', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_team_id',
			array(
				'label'     	=> esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_team_settings',
				'description'   => 'The section id, we will use this for link anchor.'
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_team_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Our Team', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_team_title',
			array(
				'label'    		=> esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_team_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_team_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_team_subtitle',
			array(
				'label'     => esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_team_settings',
				'description'   => '',
			)
		);

        // Description
        $wp_customize->add_setting( 'onepress_team_desc',
            array(
                'sanitize_callback' => 'onepress_sanitize_text',
                'default'           => '',
            )
        );
        $wp_customize->add_control( new OnePress_Editor_Custom_Control(
            $wp_customize,
            'onepress_team_desc',
            array(
                'label' 		=> esc_html__('Section Description', 'onepress'),
                'section' 		=> 'onepress_team_settings',
                'description'   => '',
            )
        ));

        // Team layout
        $wp_customize->add_setting( 'onepress_team_layout',
            array(
                'sanitize_callback' => 'sanitize_text_field',
                'default'           => '3',
            )
        );

        $wp_customize->add_control( 'onepress_team_layout',
            array(
                'label' 		=> esc_html__('Team Layout Setting', 'onepress'),
                'section' 		=> 'onepress_team_settings',
                'description'   => '',
                'type'          => 'select',
                'choices'       => array(
					'3' => esc_html__( '4 Columns', 'onepress' ),
					'4' => esc_html__( '3 Columns', 'onepress' ),
					'6' => esc_html__( '2 Columns', 'onepress' ),
                ),
            )
        );

	$wp_customize->add_section( 'onepress_team_content' ,
		array(
			'priority'    => 6,
			'title'       => esc_html__( 'Section Content', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_team',
		)
	);

		// Team member settings
		$wp_customize->add_setting(
			'onepress_team_members',
			array(
				'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
				'transport' => 'refresh', // refresh or postMessage
			) );


		$wp_customize->add_control(
			new Onepress_Customize_Repeatable_Control(
				$wp_customize,
				'onepress_team_members',
				array(
					'label'     => esc_html__('Team members', 'onepress'),
					'description'   => '',
					'section'       => 'onepress_team_content',
					//'live_title_id' => 'user_id', // apply for unput text and textarea only
					'title_format'  => esc_html__( '[live_title]', 'onepress'), // [live_title]
					'max_item'      => 4, // Maximum item can add
                    'limited_msg' 	=> wp_kses_post( 'Upgrade to <a target="_blank" href="https://www.famethemes.com/themes/onepress/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> to be able to add more items and unlock other premium features!', 'onepress' ),
                    'fields'    => array(
						'user_id' => array(
							'title' => esc_html__('User media', 'onepress'),
							'type'  =>'media',
							'desc'  => '',
						),
                        'link' => array(
                            'title' => esc_html__('Custom Link', 'onepress'),
                            'type'  =>'text',
                            'desc'  => '',
                        ),
					),

				)
			)
		);

	/*------------------------------------------------------------------------*/
    /*  Section: News
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_news' ,
		array(
			'priority'        => 138,
			'title'           => esc_html__( 'Section: News', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_news_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_news',
		)
	);

		// Show Content
		$wp_customize->add_setting( 'onepress_news_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_news_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_news_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);

		// Section ID
		$wp_customize->add_setting( 'onepress_news_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('news', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_news_id',
			array(
				'label'     => esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_news_settings',
				'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_news_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Latest News', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_news_title',
			array(
				'label'     => esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_news_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_news_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_news_subtitle',
			array(
				'label'     => esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_news_settings',
				'description'   => '',
			)
		);

        // Description
        $wp_customize->add_setting( 'onepress_news_desc',
            array(
                'sanitize_callback' => 'onepress_sanitize_text',
                'default'           => '',
            )
        );
        $wp_customize->add_control( new OnePress_Editor_Custom_Control(
            $wp_customize,
            'onepress_news_desc',
            array(
                'label' 		=> esc_html__('Section Description', 'onepress'),
                'section' 		=> 'onepress_news_settings',
                'description'   => '',
            )
        ));

		// hr
		$wp_customize->add_setting( 'onepress_news_settings_hr',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
			)
		);
		$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_news_settings_hr',
			array(
				'section'     => 'onepress_news_settings',
				'type'        => 'hr'
			)
		));

		// Number of post to show.
		$wp_customize->add_setting( 'onepress_news_number',
			array(
				'sanitize_callback' => 'onepress_sanitize_number',
				'default'           => '3',
			)
		);
		$wp_customize->add_control( 'onepress_news_number',
			array(
				'label'     	=> esc_html__('Number of post to show', 'onepress'),
				'section' 		=> 'onepress_news_settings',
				'description'   => '',
			)
		);

		// Blog Button
		$wp_customize->add_setting( 'onepress_news_more_link',
			array(
				'sanitize_callback' => 'esc_url',
				'default'           => '#',
			)
		);
		$wp_customize->add_control( 'onepress_news_more_link',
			array(
				'label'       => esc_html__('More News button link', 'onepress'),
				'section'     => 'onepress_news_settings',
				'description' => esc_html__(  'It should be your blog page link.', 'onepress' )
			)
		);
		$wp_customize->add_setting( 'onepress_news_more_text',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Read Our Blog', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_news_more_text',
			array(
				'label'     	=> esc_html__('More News Button Text', 'onepress'),
				'section' 		=> 'onepress_news_settings',
				'description'   => '',
			)
		);

	/*------------------------------------------------------------------------*/
    /*  Section: Contact
    /*------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'onepress_contact' ,
		array(
			'priority'        => 140,
			'title'           => esc_html__( 'Section: Contact', 'onepress' ),
			'description'     => '',
			'active_callback' => 'onepress_showon_frontpage'
		)
	);

	$wp_customize->add_section( 'onepress_contact_settings' ,
		array(
			'priority'    => 3,
			'title'       => esc_html__( 'Section Settings', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_contact',
		)
	);

		// Show Content
		$wp_customize->add_setting( 'onepress_contact_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide this section?', 'onepress'),
				'section'     => 'onepress_contact_settings',
				'description' => esc_html__('Check this box to hide this section.', 'onepress'),
			)
		);

		// Section ID
		$wp_customize->add_setting( 'onepress_contact_id',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => esc_html__('contact', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_contact_id',
			array(
				'label'     => esc_html__('Section ID:', 'onepress'),
				'section' 		=> 'onepress_contact_settings',
				'description'   => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' )
			)
		);

		// Title
		$wp_customize->add_setting( 'onepress_contact_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Get in touch', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_contact_title',
			array(
				'label'     => esc_html__('Section Title', 'onepress'),
				'section' 		=> 'onepress_contact_settings',
				'description'   => '',
			)
		);

		// Sub Title
		$wp_customize->add_setting( 'onepress_contact_subtitle',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__('Section subtitle', 'onepress'),
			)
		);
		$wp_customize->add_control( 'onepress_contact_subtitle',
			array(
				'label'     => esc_html__('Section Subtitle', 'onepress'),
				'section' 		=> 'onepress_contact_settings',
				'description'   => '',
			)
		);

        // Description
        $wp_customize->add_setting( 'onepress_contact_desc',
            array(
                'sanitize_callback' => 'onepress_sanitize_text',
                'default'           => '',
            )
        );
        $wp_customize->add_control( new OnePress_Editor_Custom_Control(
            $wp_customize,
            'onepress_contact_desc',
            array(
                'label' 		=> esc_html__('Section Description', 'onepress'),
                'section' 		=> 'onepress_contact_settings',
                'description'   => '',
            )
        ));


	$wp_customize->add_section( 'onepress_contact_content' ,
		array(
			'priority'    => 6,
			'title'       => esc_html__( 'Section Content', 'onepress' ),
			'description' => '',
			'panel'       => 'onepress_contact',
		)
	);
		// Contact form 7 guide.
		$wp_customize->add_setting( 'onepress_contact_cf7_guide',
			array(
				'sanitize_callback' => 'onepress_sanitize_text'
			)
		);
		$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_contact_cf7_guide',
			array(
				'section'     => 'onepress_contact_content',
				'type'        => 'custom_message',
				'description' => wp_kses_post( 'In order to display contact form please install <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> plugin and then copy the contact form shortcode and paste it here, the shortcode will be like this <code>[contact-form-7 id="xxxx" title="Example Contact Form"]</code>', 'onepress' )
			)
		));

		// Contact Form 7 Shortcode
		$wp_customize->add_setting( 'onepress_contact_cf7',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_cf7',
			array(
				'label'     	=> esc_html__('Contact Form 7 Shortcode.', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		// Show CF7
		$wp_customize->add_setting( 'onepress_contact_cf7_disable',
			array(
				'sanitize_callback' => 'onepress_sanitize_checkbox',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_cf7_disable',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__('Hide contact form completely.', 'onepress'),
				'section'     => 'onepress_contact_content',
				'description' => esc_html__('Check this box to hide contact form.', 'onepress'),
			)
		);

		// Contact Text
		$wp_customize->add_setting( 'onepress_contact_text',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( new OnePress_Editor_Custom_Control(
			$wp_customize,
			'onepress_contact_text',
			array(
				'label'     	=> esc_html__('Contact Text', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		));

		// hr
		$wp_customize->add_setting( 'onepress_contact_text_hr', array( 'sanitize_callback' => 'onepress_sanitize_text' ) );
		$wp_customize->add_control( new OnePress_Misc_Control( $wp_customize, 'onepress_contact_text_hr',
			array(
				'section'     => 'onepress_contact_content',
				'type'        => 'hr'
			)
		));

		// Address Box
		$wp_customize->add_setting( 'onepress_contact_address_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_address_title',
			array(
				'label'     	=> esc_html__('Contact Box Title', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		// Contact Text
		$wp_customize->add_setting( 'onepress_contact_address',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_address',
			array(
				'label'     => esc_html__('Address', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		// Contact Phone
		$wp_customize->add_setting( 'onepress_contact_phone',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_phone',
			array(
				'label'     	=> esc_html__('Phone', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		// Contact Email
		$wp_customize->add_setting( 'onepress_contact_email',
			array(
				'sanitize_callback' => 'sanitize_email',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_email',
			array(
				'label'     	=> esc_html__('Email', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		// Contact Fax
		$wp_customize->add_setting( 'onepress_contact_fax',
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'onepress_contact_fax',
			array(
				'label'     	=> esc_html__('Fax', 'onepress'),
				'section' 		=> 'onepress_contact_content',
				'description'   => '',
			)
		);

		/**
		 * Hook to add other customize
		 */
		do_action( 'onepress_customize_after_register', $wp_customize );

}
add_action( 'customize_register', 'onepress_customize_register' );
/**
 * Selective refresh
 */
require get_template_directory() . '/inc/customizer-selective-refresh.php';


/*------------------------------------------------------------------------*/
/*  OnePress Sanitize Functions.
/*------------------------------------------------------------------------*/

function onepress_sanitize_file_url( $file_url ) {
	$output = '';
	$filetype = wp_check_filetype( $file_url );
	if ( $filetype["ext"] ) {
		$output = esc_url( $file_url );
	}
	return $output;
}


/**
 * Conditional to show more hero settings
 *
 * @param $control
 * @return bool
 */
function onepress_hero_fullscreen_callback ( $control ) {
	if ( $control->manager->get_setting('onepress_hero_fullscreen')->value() == '' ) {
        return true;
    } else {
        return false;
    }
}


function onepress_sanitize_number( $input ) {
    return balanceTags( $input );
}

function onepress_sanitize_hex_color( $color ) {
	if ( $color === '' ) {
		return '';
	}
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
	return null;
}

function onepress_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
		return 1;
    } else {
		return 0;
    }
}

function onepress_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

function onepress_sanitize_html_input( $string ) {
	return wp_kses_allowed_html( $string );
}

function onepress_showon_frontpage() {
	return is_page_template( 'template-frontpage.php' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function onepress_customize_preview_js() {
    wp_enqueue_script( 'onepress_customizer_liveview', get_template_directory_uri() . '/assets/js/customizer-liveview.js', array( 'customize-preview', 'customize-selective-refresh' ), false, true );
}
add_action( 'customize_preview_init', 'onepress_customize_preview_js', 65 );



add_action( 'customize_controls_enqueue_scripts', 'opneress_customize_js_settings' );
function opneress_customize_js_settings(){
    if ( ! function_exists( 'onepress_get_actions_required' ) ) {
        return;
    }
    $actions = onepress_get_actions_required();
    $n = array_count_values( $actions );
    $number_action =  0;
    if ( $n && isset( $n['active'] ) ) {
        $number_action = $n['active'];
    }

    wp_localize_script( 'customize-controls', 'onepress_customizer_settings', array(
        'number_action' => $number_action,
        'is_plus_activated' => class_exists( 'OnePress_PLus' ) ? 'y' : 'n',
        'action_url' => admin_url( 'themes.php?page=ft_onepress&tab=actions_required' ),
    ) );
}
