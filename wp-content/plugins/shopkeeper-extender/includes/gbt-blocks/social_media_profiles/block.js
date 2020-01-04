( function( blocks, components, editor, i18n, element ) {

	const el = element.createElement;

	/* Blocks */
	const registerBlockType   	= blocks.registerBlockType;

	const {
		TextControl,
		RangeControl,
		SVG,
		Path,
	} = wp.components;

	const {
		ServerSideRender,
		PanelColorSettings,
		InspectorControls,
		BlockControls,
		AlignmentToolbar,
	} = wp.editor;

	/* Register Block */
	registerBlockType( 'getbowtied/sk-social-media-profiles', {
		title: i18n.__( 'Social Media Profiles', 'shopkeeper-extender' ),
		icon:
			el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 24 24' },
				el( Path, { d:'M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z' } ),
			),
		category: 'shopkeeper',
		attributes: {
			fontSize: {
				type: 	 'number',
				default: '24'
			},
			fontColor: {
				type: 	 'string',
				default: '#000'
			},
			align: {
				type: 	 'string',
				default: 'left'
			},
		},

		edit: function( props ) {

			let attributes = props.attributes;

			return [
				el( 
					InspectorControls, 
					{ 
						key: 'gbt_18_sk_socials_settings'
					},
					el(
						'div',
						{
							className: 'main-inspector-wrapper',
						},
						el(
							RangeControl,
							{
								key: "gbt_18_sk_socials_font_size",
								value: attributes.fontSize,
								allowReset: false,
								initialPosition: 24,
								min: 10,
								max: 36,
								label: i18n.__( 'Icons Font Size', 'shopkeeper-extender' ),
								onChange: function( newNumber ) {
									props.setAttributes( { fontSize: newNumber } );
								},
							}
						),
						el(
							PanelColorSettings,
							{
								key: 'gbt_18_sk_socials_icons_color',
								title: i18n.__( 'Icons Color', 'shopkeeper-extender' ),
								colorSettings: [
									{ 
										label: i18n.__( 'Icons Color', 'shopkeeper-extender' ),
										value: attributes.fontColor,
										onChange: function( newColor) {
											props.setAttributes( { fontColor: newColor } );
										},
									},
								]
							},
						),
					),
				),
				el(
					BlockControls,
					{ 
						key: 'gbt_18_sk_socials_alignment_controls'
					},
					el(
						AlignmentToolbar, 
						{
							key: 'gbt_18_sk_socials_alignment',
							value: attributes.align,
							onChange: function( newAlignment ) {
								props.setAttributes( { align: newAlignment } );
							}
						} 
					),
				),
				el( 
					'div',
					{ 
						key: 		'gbt_18_sk_editor_social_media_wrapper',
						className: 	'gbt_18_sk_editor_social_media_wrapper'
					},
					el(
						'p',
						{
							key: 		'gbt_18_sk_editor_social_media_setup',
							className: 	'gbt_18_sk_editor_social_media_setup',
						},
						i18n.__('Setup social profile links under Appearance > Customize > Social Media', 'shopkeeper-extender' ),
					),
				),
				el(
					ServerSideRender,
					{
						block: 'getbowtied/sk-social-media-profiles',
						attributes: props.attributes
					}
				),
			];
		},

		save: function() {
			return null;
		},
	} );

} )(
	window.wp.blocks,
	window.wp.components,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element
);