( function( wp, blocks, i18n, element ) {

	const el = element.createElement;

	/* Blocks */
	const registerBlockType   	= wp.blocks.registerBlockType;

	const InspectorControls 	= wp.editor.InspectorControls;

	const TextControl 			= wp.components.TextControl;
	const RadioControl       	= wp.components.RadioControl;
	const SelectControl			= wp.components.SelectControl;
	const ToggleControl			= wp.components.ToggleControl;
	const RangeControl			= wp.components.RangeControl;
	const SVG 					= wp.components.SVG;
	const Path 					= wp.components.Path;

	const apiFetch 				= wp.apiFetch;

	/* Register Block */
	registerBlockType( 'getbowtied/sk-portfolio', {
		title: i18n.__( 'Portfolio', 'shopkeeper-portfolio' ),
		icon:
			el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 24 24' },
				el( Path, { d:'M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z' } ),
			),
		category: 'shopkeeper',
		supports: {
			align: [ 'center', 'wide', 'full' ],
		},
		styles: [
			{ name: 'default', label:    i18n.__( 'Equal Boxes', 'shopkeeper-portfolio' ), isDefault: true },
			{ name: 'masonry_1', label:  i18n.__( 'Masonry Style V1', 'shopkeeper-portfolio' ) },
			{ name: 'masonry_2', label:  i18n.__( 'Masonry Style V2', 'shopkeeper-portfolio' ) },
			{ name: 'masonry_3', label:  i18n.__( 'Masonry Style V3', 'shopkeeper-portfolio' ) },
		],
		attributes: {
			/* Products source */
			result: {
				type: 'array',
				default: [],
			},
			queryItems: {
				type: 'string',
				default: '',
			},
			queryItemsLast: {
				type: 'string',
				default: '',
			},
			/* loader */
			isLoading: {
				type: 'bool',
				default: false,
			},
			/* Display by category */
			categoriesIDs: {
				type: 'string',
				default: ',',
			},
			categoriesSavedIDs: {
				type: 'string',
				default: '',
			},
			/* First Load */
			firstLoad: {
				type: 'boolean',
				default: true
			},
			/* Number of Portfolio Items */
			number: {
				type: 'number',
				default: '12'
			},
			/* Columns */
			columns: {
				type: 'number',
				default: '3'
			},
			/* Filters */
			showFilters: {
				type: 'boolean',
				default: false,
			},
			/* Orderby */
			orderby: {
				type: 'string',
				default: 'date_desc'
			},
		},

		edit: function( props ) {

			let attributes = props.attributes;
			let className  = props.className;

			attributes.doneFirstLoad 		= attributes.doneFirstLoad || false;
			attributes.categoryOptions 		= attributes.categoryOptions || [];
			attributes.doneFirstItemsLoad 	= attributes.doneFirstItemsLoad || false;
			attributes.result 				= attributes.result || [];

			if( className.indexOf('is-style-') == -1 ) { className += ' is-style-default'; }

			//==============================================================================
			//	Helper functions
			//==============================================================================

			function _buildQuery( arr, nr, order ) {
				let query = '/wp/v2/portfolio-item?per_page=' + nr;

				if( arr.substr(0,1) == ',' ) {
					arr = arr.substr(1);
				}
				if( arr.substr(arr.length - 1) == ',' ) {
					arr = arr.substring(0, arr.length - 1);
				}

				if( arr != ',' && arr != '' ) {
					query = '/wp/v2/portfolio-item?portfolio-category=' + arr + '&per_page=' + nr;
				}

				switch (order) {
					case 'date_asc':
						query += '&orderby=date&order=asc';
						break;
					case 'date_desc':
						query += '&orderby=date&order=desc';
						break;
					case 'title_asc':
						query += '&orderby=title&order=asc';
						break;
					case 'title_desc':
						query += '&orderby=title&order=desc';
						break;
					default: 
						break;
				}	

				return query;
			}

			function _verifyCatIDs( optionsIDs ) {

				let catArr = attributes.categoriesIDs;
				let categoriesIDs = attributes.categoriesIDs;

				if( catArr.substr(0,1) == ',' ) {
					catArr = catArr.substr(1);
				}
				if( catArr.substr(catArr.length - 1) == ',' ) {
					catArr = catArr.substring(0, catArr.length - 1);
				}

				if( catArr != ',' && catArr != '' ) {

					let newCatArr = catArr.split(',');
					let newArr = [];
					for (let i = 0; i < newCatArr.length; i++) {
						if( optionsIDs.indexOf(newCatArr[i]) == -1 ) {
							categoriesIDs = categoriesIDs.replace(',' + newCatArr[i].toString() + ',', ',');
						}
					}
				}

				if( attributes.categoriesIDs != categoriesIDs ) {
					props.setAttributes({ queryItems: _buildQuery(categoriesIDs, attributes.number, attributes.orderby) });
					props.setAttributes({ queryItemsLast: _buildQuery(categoriesIDs, attributes.number, attributes.orderby) });
				}

				props.setAttributes({ categoriesIDs: categoriesIDs });
				props.setAttributes({ categoriesSavedIDs: categoriesIDs });
			}

			function getWrapperClass() {
				if( className.indexOf('is-style-default') >= 0 ) {
					return 'gbt_18_sk_editor_portfolio_wrapper items_per_row_' + attributes.columns;
				}
				return 'gbt_18_sk_editor_portfolio_wrapper';
			}

			function _sortCategories( index, arr, newarr = [], level = 0) {
				for ( let i = 0; i < arr.length; i++ ) {
					if ( arr[i].parent == index) {
						arr[i].level = level;
						newarr.push(arr[i]);
						_sortCategories(arr[i].value, arr, newarr, level + 1 );
					}
				}

				return newarr;
			}

			function _isChecked( needle, haystack ) {
				let idx = haystack.indexOf(needle.toString());
				if ( idx != - 1) {
					return true;
				}
				return false;
			}

			function _categoryClassName(parent, value) {
				if ( parent == 0) {
					return 'parent parent-' + value;
				} else {
					return 'child child-' + parent;
				}
			}

			function _isLoadingText(){
				if ( attributes.isLoading  === false ) {
					return i18n.__( 'Update', 'shopkeeper-portfolio' );
				} else {
					return i18n.__( 'Updating', 'shopkeeper-portfolio' );
				}
			}

			function _isDonePossible() {
				return ( (attributes.queryItems.length == 0) || (attributes.queryItems === attributes.queryItemsLast) );
			}

			function _isLoading() {
				if ( attributes.isLoading  === true ) {
					return 'is-busy';
				} else {
					return '';
				}
			}

			//==============================================================================
			//	Show portfolio items functions
			//==============================================================================

			function getPortfolioItems() {
				let query = attributes.queryItems;
				props.setAttributes({ queryItemsLast: query});

				if (query != '') {
					apiFetch({ path: query }).then(function (items) {
						props.setAttributes({ result: items});
						props.setAttributes({ isLoading: false});
						props.setAttributes({ doneFirstItemsLoad: true});
					});
				}
			}

			function renderResults() {
				if ( attributes.firstLoad === true ) {
					apiFetch({ path: '/wp/v2/portfolio-item?per_page=12&orderby=date&order=desc' }).then(function (portfolio_items) {
						props.setAttributes({ result: portfolio_items });
						props.setAttributes({ firstLoad: false });
						let query = '/wp/v2/portfolio-item?per_page=12&orderby=date&order=desc';
						props.setAttributes({queryItems: query});
						props.setAttributes({ queryItemsLast: query});
					});
				}

				let portfolio_items = attributes.result;
				let postElements = [];
				let wrapper = [];

				if( portfolio_items.length > 0) {

					for ( let i = 0; i < portfolio_items.length; i++ ) {

						let portfolio_image = [];
						if ( portfolio_items[i]['fimg_url'] ) { 
							portfolio_image.push(
								el( 'span',
									{
										key: 		'gbt_18_sk_editor_portfolio_item_thumbnail',
										className: 	'gbt_18_sk_editor_portfolio_item_thumbnail',
										style:
										{
											backgroundImage: 'url(' + portfolio_items[i]['fimg_url'] + ')'
										}
									}
								)
							);
						};
 
						postElements.push(
							el( "div", 
								{
									key: 		'gbt_18_sk_editor_portfolio_item_box_' + portfolio_items[i].id, 
									className: 	'gbt_18_sk_editor_portfolio_item_box'
								},
								el( 'a',
									{
										key: 		'gbt_18_sk_editor_portfolio_item_link',
										className: 	'gbt_18_sk_editor_portfolio_item_link',
										style:
										{
											backgroundColor: portfolio_items[i]['color_meta_box']
										}
									},
									el( "div", 
										{
											key: 		'gbt_18_sk_editor_portfolio_item_content', 
											className: 	'gbt_18_sk_editor_portfolio_item_content'
										},
										portfolio_image,
										el( 'h2',
											{
												key: 'gbt_18_sk_editor_portfolio_item_title',
												className: 'gbt_18_sk_editor_portfolio_item_title',
												dangerouslySetInnerHTML: { __html: portfolio_items[i]['title']['rendered'] }
											}
										),
									)
								)
							)
						);
					}
				} 

				wrapper.push(
					el( 'div',
						{
							key: 		'gbt_18_sk_editor_portfolio_items',
							className: 	'gbt_18_sk_editor_portfolio_items'
						},
						postElements
					)
				);

				return wrapper;
			}

			//==============================================================================
			//	Display Categories
			//==============================================================================

			function getCategories() {

				let categories_list = [];
				let options = [];
				let optionsIDs = [];
				let sorted = [];
			
				apiFetch({ path: '/wp/v2/portfolio-category?per_page=-1' }).then(function (categories) {

				 	for( let i = 0; i < categories.length; i++) {
	        			options[i] = {'label': categories[i].name.replace(/&amp;/g, '&'), 'value': categories[i].id, 'parent': categories[i].parent, 'count': categories[i].count };
				 		optionsIDs[i] = categories[i].id.toString();
				 	}

				 	sorted = _sortCategories(0, options);
		        	props.setAttributes({categoryOptions: sorted });
		        	_verifyCatIDs(optionsIDs);
	        		props.setAttributes({ doneFirstLoad: true});
				});
			}

			function renderCategories( parent = 0, level = 0 ) {

				let categoryElements = [];
				let catArr = attributes.categoryOptions;
				if ( catArr.length > 0 )
				{
					for ( let i = 0; i < catArr.length; i++ ) {
						 if ( catArr[i].parent !=  parent ) { continue; };
						categoryElements.push(
							el(
								'li',
								{
									className: 'level-' + catArr[i].level,
								},
								el(
								'label',
									{
										className: _categoryClassName( catArr[i].parent, catArr[i].value ) + ' ' + catArr[i].level,
									},
									el(
									'input', 
										{
											type:  'checkbox',
											key:   'category-checkbox-' + catArr[i].value,
											value: catArr[i].value,
											'data-index': i,
											'data-parent': catArr[i].parent,
											checked: _isChecked(','+catArr[i].value+',', attributes.categoriesIDs),
											onChange: function onChange(evt){
												let newCategoriesSelected = attributes.categoriesIDs;
												let index = newCategoriesSelected.indexOf(',' + evt.target.value + ',');
												if (evt.target.checked === true) {
													if (index == -1) {
														newCategoriesSelected += evt.target.value + ',';
													}
												} else {
													if (index > -1) {
														newCategoriesSelected = newCategoriesSelected.replace(',' + evt.target.value + ',', ',');
													}
												}
												props.setAttributes({ categoriesIDs: newCategoriesSelected });
												props.setAttributes({ queryItems: _buildQuery(newCategoriesSelected, attributes.number, attributes.orderby) });
											},
										}, 
									),
									catArr[i].label,
									el(
										'sup',
										{},
										catArr[i].count,
									),
								),
								renderCategories( catArr[i].value, level+1)
							),
						);
					} 
				}	
				if (categoryElements.length > 0 ) {
					let wrapper = el('ul', {className: 'level-' + level}, categoryElements);
					return wrapper;		
				} else {
					return;
				}
			}

			return [
				el(
					InspectorControls,
					{
						key: 'sk-portfolio-inspector'
					},
					el(
						'div',
						{
							className: 'main-inspector-wrapper',
						},
						el( 'label', { className: 'components-base-control__label' }, i18n.__( 'Categories:', 'shopkeeper-portfolio' ) ),
						el(
							'div',
							{
								className: 'category-result-wrapper',
							},
							attributes.categoryOptions.length < 1 && attributes.doneFirstLoad === false && getCategories(),
							renderCategories(),
						),
						el(
							SelectControl,
							{
								key: 'sk-latest-posts-order-by',
								options:
									[
										{ value: 'title_asc',   label: i18n.__( 'Alphabetical Ascending', 'shopkeeper-portfolio' ) },
										{ value: 'title_desc',  label: i18n.__( 'Alphabetical Descending', 'shopkeeper-portfolio' ) },
										{ value: 'date_asc',   	label: i18n.__( 'Date Ascending', 'shopkeeper-portfolio' ) },
										{ value: 'date_desc',  	label: i18n.__( 'Date Descending', 'shopkeeper-portfolio' ) },
									],
	              				label: i18n.__( 'Order By', 'shopkeeper-portfolio' ),
	              				value: attributes.orderby,
	              				onChange: function( value ) {
	              					props.setAttributes( { orderby: value } );
	              					let newCategoriesSelected = attributes.categoriesIDs;
									props.setAttributes({ queryItems: _buildQuery(newCategoriesSelected, attributes.number, value) });
								},
							}
						),
						el(
							RangeControl,
							{
								key: "sk-portfolio-number",
								className: 'range-wrapper',
								value: attributes.number,
								allowReset: false,
								initialPosition: 12,
								min: 1,
								max: 20,
								label: i18n.__( 'Number of Portfolio Items', 'shopkeeper-portfolio' ),
								onChange: function onChange(newNumber){
									props.setAttributes( { number: newNumber } );
									let newCategoriesSelected = attributes.categoriesIDs;
									props.setAttributes({ queryItems: _buildQuery(newCategoriesSelected, newNumber, attributes.orderby) });
								},
							}
						),
						el(
							'button',
							{
								className: 'render-results components-button is-button is-default is-primary is-large ' + _isLoading(),
								disabled: _isDonePossible(),
								onClick: function onChange(e) {
									props.setAttributes({ isLoading: true });
									props.setAttributes({ categoriesSavedIDs: attributes.categoriesIDs });
									getPortfolioItems();
								},
							},
							_isLoadingText(),
						),
						el( 'hr', {} ),
						el(
							ToggleControl,
							{
								key: "portfolio-filters-toggle",
	              				label: i18n.__( 'Show Filters?', 'shopkeeper-portfolio' ),
	              				checked: attributes.showFilters,
	              				onChange: function() {
									props.setAttributes( { showFilters: ! attributes.showFilters } );
								},
							}
						),
						props.className.indexOf('is-style-default') !== -1 && el(
							RangeControl,
							{
								key: "sk-portfolio-columns",
								value: attributes.columns,
								allowReset: false,
								initialPosition: 3,
								min: 2,
								max: 5,
								label: i18n.__( 'Columns', 'shopkeeper-portfolio' ),
								onChange: function( newColumns ) {
									props.setAttributes( { columns: newColumns } );
								},
							}
						),
					),
				),
				el( 'div',
					{
						key: 		'gbt_18_sk_editor_portfolio',
						className: 	'gbt_18_sk_editor_portfolio ' + className
					},
					el( 'div',
						{
							key: 		'gbt_18_sk_editor_portfolio_wrapper',
							className: 	getWrapperClass(),
						},
						attributes.result.length < 1 && attributes.doneFirstItemsLoad === false && getPortfolioItems(),
						renderResults()
					),
				)
			];
		},

		save: function() {
			return null;
		},
	} );

} )(
	window.wp,
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element
);