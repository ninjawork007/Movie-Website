( function( blocks, components, editor, i18n, element ) {

	const el = element.createElement;

	/* Blocks */
	const registerBlockType   	= blocks.registerBlockType;

	const InspectorControls 	= editor.InspectorControls;

	const TextControl 			= components.TextControl;
	const RadioControl        	= components.RadioControl;
	const SelectControl			= components.SelectControl;
	const ToggleControl			= components.ToggleControl;
	const SVG 					= components.SVG;
	const Path 					= components.Path;

	const apiFetch 				= wp.apiFetch;

	/* Register Block */
	registerBlockType( 'getbowtied/sk-categories-grid', {
		title: i18n.__( 'Product Categories - Grid', 'shopkeeper-extender' ),
		icon: el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 24 24' },
				el( Path, { d:'M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z' } ) 
			),
		category: 'shopkeeper',
		supports: {
			align: [ 'center', 'wide', 'full' ],
		},
		attributes: {
			categoryIDs: {
				type: 'string',
				default: '',
			},
		/* Products source */
			result: {
				type: 'array',
				default: [],
			},
			queryCategories: {
				type: 'string',
				default: '',
			},
			queryCategoriesLast: {
				type: 'string',
				default: '',
			},
			queryDisplayType: {
				type: 'string',
				default: 'all_categories',
			},
		/* loader */
			isLoading: {
				type: 'bool',
				default: false,
			},
		/* Manually pick products */
			querySearchString: {
				type: 'string',
				default: '',
			},
			querySearchResults: {
				type: 'array',
				default: [],
			},
			querySearchNoResults: {
				type: 'bool',
				default: false,
			},
			querySearchSelected: {
				type: 'array',
				default: [],
			},
		/* Order by */
			queryOrder: {
				type: 'string',
				default: '',
			},
			parentOnly: {
				type: 'bool',
				default: false,
			},
			hideEmpty: {
				type: 'bool',
				default: false,
			},
			orderby: {
				type: 'string',
				default: 'menu_order',
			},
			productCount: {
				type: 'bool',
				default: true,
			},
		/* First Load */
			firstLoad: {
				type: 'bool',
				default: true,
			},
			limit: {
				type: 'int',
				default: 8,
			},
		/* Columns */
			columns: {
				type: 'int',
				default: 3,
			}
		},
		edit: function( props ) {

			let attributes = props.attributes;
			attributes.selectedIDS = attributes.selectedIDS || [];
			attributes.doneFirstPostsLoad 	= attributes.doneFirstPostsLoad || false;

		//==============================================================================
		//	Helper functions
		//==============================================================================

			function _categoryClassName(parent, value) {
				if ( parent == 0) {
					return 'parent parent-' + value;
				} else {
					return 'child child-' + parent;
				}
			}

			function _searchResultClass(theID){
				const index = attributes.selectedIDS.indexOf(theID);
				if ( index == -1) {
					return 'single-result';
				} else {
					return 'single-result selected';
				}
			}

			function _sortCategories( index, arr, newarr = [], level = 0) {
				for ( let i = 0; i < arr.length; i++ ) {
					if ( arr[i].parent == index) {
						arr[i].level = level;
						newarr.push(arr[i]);
						_sortCategories(arr[i].id, arr, newarr, level + 1 );
					}
				}

				return newarr;
			}

			function _sortByKeys(keys, products) {
				let sorted =[];
				for ( let i = 0; i < keys.length; i++ ) {
					for ( let j = 0; j < products.length; j++ ) {
						if ( keys[i] == products[j].id ) {
							sorted.push(products[j]);
							break;
						}
					}
				}

				return sorted;
			}

			function _destroyQuery() {
				props.setAttributes({ queryOrder: ''});
				props.setAttributes({ queryCategories: ''});
				props.setAttributes({ querySearchString: ''});
				props.setAttributes({ querySearchResults: []});
				props.setAttributes({ querySearchSelected: []});
				props.setAttributes({ selectedIDS: []});
				props.setAttributes({ queryAttributesOptionsSelected: [] });
				props.setAttributes({ queryCategorySelected: [] });
				props.setAttributes({result: []});
			}

			function _destroyTempAtts() {
				props.setAttributes({ querySearchString: ''});
				props.setAttributes({ querySearchResults: []});
			}

			function _isChecked( needle, haystack ) {
				const idx = haystack.indexOf(needle.toString());
				if ( idx != - 1) {
					return true;
				}
				return false;
			}

			function _isDonePossible() {
				return ( (attributes.queryCategories.length == 0) || (_buildQuery(attributes.limit, attributes.orderby, attributes.parentOnly, attributes.hideEmpty) === attributes.queryCategoriesLast) );
			}

			function _isLoading() {
				if ( attributes.isLoading  === true ) {
					return 'is-busy';
				} else {
					return '';
				}
			}

			function _isLoadingText(){
				if ( attributes.isLoading  === false ) {
					return i18n.__('Update', 'shopkeeper-extender');
				} else {
					return i18n.__('Updating', 'shopkeeper-extender');
				}
			}

		//==============================================================================
		//	Show products functions
		//==============================================================================
			function getQuery( query ) {
				return '/wc/v3/products/categories' + query;
			}

			function getResult() {
				let query;

				if ( attributes.queryDisplayType == 'all_categories' ) {
					query = _buildQuery(attributes.limit, attributes.orderby, attributes.parentOnly, attributes.hideEmpty);
				} else {
					query = attributes.queryCategories;
				}
				props.setAttributes({ queryCategoriesLast: query});
				props.setAttributes({ doneFirstPostsLoad: true});

				if (query != '') {
					apiFetch({ path: query }).then(function (categories) {
						if ( attributes.orderby == 'menu_order' && attributes.queryDisplayType == 'all_categories') {
							categories = _sortCategories(0, categories);
						}
						props.setAttributes({ result: categories});
						props.setAttributes({ isLoading: false});
						let IDs = '';
						for ( let i = 0; i < categories.length; i++) {
							IDs += categories[i].id + ',';
						}
						props.setAttributes({ categoryIDs: IDs});
					});
				}
			}

			function renderResults() {
				if ( attributes.firstLoad === true ) {
					let query = _buildQuery(attributes.limit, attributes.orderby, attributes.parentOnly, attributes.hideEmpty);
					apiFetch({ path: query }).then(function (categories) {
						categories = _sortCategories(0, categories);
						props.setAttributes({ result: categories });
						props.setAttributes({ firstLoad: false });
						props.setAttributes({queryCategories: query});
						props.setAttributes({queryCategoriesLast: query});

						let IDs = '';
						for ( let i = 0; i < categories.length; i++) {
							IDs += categories[i].id + ',';
						}
						props.setAttributes({ categoryIDs: IDs});
					});
				}

				let categories = attributes.result;
				let categoryElements = [];
				let wrapper = [];
				let cat_counter = 0;
				let cat_class = "";

				for ( let i = 0; i < categories.length; i++ ) {

					cat_class = "";
					cat_counter++;   

					switch ( categories.length ) {
						case 1:
							cat_class = "one_cat_" + cat_counter;
							break;
						case 2:
							cat_class = "two_cat_" + cat_counter;
							break;
						case 3:
							cat_class = "three_cat_" + cat_counter;
							break;
						case 4:
							cat_class = "four_cat_" + cat_counter;
							break;
						case 5:
							cat_class = "five_cat_" + cat_counter;
							break;
						default:
							if (cat_counter < 7) {
								cat_class = cat_counter;
							} else {
								cat_class = "more_than_6";
							}
					}

					let img = '';
					if ( categories[i].image !== null ) { img = categories[i]['image']['src'] } else { img = '' };
					categoryElements.push(
						el( 'div',
							{	
								key: 		'gbt_18_sk_editor_category_' + cat_class + '_item-' + categories[i].id,
								className: 	'gbt_18_sk_editor_category_' + cat_class
							},
							el( 'div',
								{
									key: 		'gbt_18_sk_editor_category_grid_box',
									className: 	'gbt_18_sk_editor_category_grid_box'
								},
								el( 'span',
									{
										key: 		'gbt_18_sk_editor_category_item_bkg',
										className: 	'gbt_18_sk_editor_category_item_bkg',
										style:
											{
												backgroundImage: 'url(' + img + ')'
											}
									}
								),
								el( 'a',
									{
										key: 		'gbt_18_sk_editor_category_item',
										className: 	'gbt_18_sk_editor_category_item'
									},
									el( 'span',
										{
											key: 		'gbt_18_sk_editor_category_name',
											className: 	'gbt_18_sk_category_name'
										},
										categories[i]['name'].replace(/&amp;/g, '&'),
										attributes.productCount === true && el( 'span',
											{
												key: 		'gbt_18_sk_editor_category_count',
												className: 	'gbt_18_sk_category_count',
											},
											categories[i]['count']
										),
									)
								)
							)
						)
					);
				}

				wrapper.push(
					el( 'div',
						{
							key: 		'gbt_18_sk_editor_categories_grid',
							className: 	'gbt_18_sk_editor_categories_grid'
						},
						categoryElements,
						el(	'div',
						{
							key: 		'clearfix',
							className: 	'clearfix'
						}
						),
					),
				);

				return wrapper;
			}

			function _buildQuery(limit = 10, orderby='menu_order', parentOnly=true, hideEmpty=true) {
				if ( attributes.queryDisplayType === 'specific' ) {
					return attributes.queryCategories;
				}
				let query = getQuery('?per_page=' + limit);

				switch (orderby) {
					case 'menu_order':
						break;
					case 'title_asc':
						query += '&orderby=slug&order=asc';
						break;
					case 'title_desc':
						query += '&orderby=slug&order=desc';
						break;
					default: 
						break;
				}

				if (parentOnly === true ) {
					query+= '&parent=0';
				}

				if ( hideEmpty === true ) {
					query+= '&hide_empty=true';
				}
				return query;
			}

			function _getQueryOrder() {
				if ( attributes.queryOrder.length < 1) return '';
				let order = '';
				switch ( attributes.queryOrder ) {
					case 'date_desc':
						order = '&orderby=date&order=desc';
					break;
					case 'date_asc':
						order = '&orderby=date&order=asc';
					break;
					case 'title_desc':
						order = '&orderby=title&order=desc';
					break;
					case 'title_asc':
						order = '&orderby=title&order=asc';
					break;
					default: 
						
					break;
				}

				return order;
			}

		//==============================================================================
		//	Display ajax results
		//==============================================================================
			function renderSearchResults() {
				let categoryElements = [];

				if ( attributes.querySearchNoResults == true) {
					return el('span', {className: 'no-results'}, i18n.__('No categories matching.', 'shopkeeper-extender'));
				}
				let categories = attributes.querySearchResults;
				for ( let i = 0; i < categories.length; i++ ) {
					let img;
					if ( categories[i].image !== null && categories[i].image.src != '' ) {
						img = el('span', { className: 'img-wrapper', dangerouslySetInnerHTML: { __html: '<span class="img" style="background-image: url(\''+categories[i].image.src+'\')"></span>'}});
					} else {
						img = el('span', { className: 'img-wrapper', dangerouslySetInnerHTML: { __html: '<span class="img" style="background-image: url(\''+getbowtied_pbw.woo_placeholder_image+'\')"></span>'}});
					}
					categoryElements.push(
						el(
							'span', 
							{
								key: 	   'item-' + categories[i].id,
								className: _searchResultClass(categories[i].id),
								title: categories[i].name.replace(/&amp;/g, '&'),
								'data-index': i,
							}, 
							img,
							el(
								'label', 
								{
									className: 'title-wrapper'
								},
								el(
									'input',
									{
										type: 'checkbox',
										value: i,
										onChange: function onChange(evt) {
											let _this = evt.target;
											let qSR = attributes.selectedIDS;
											let index = qSR.indexOf(categories[evt.target.value].id);
											if (index == -1) {
												qSR.push(categories[evt.target.value].id);
											} else {
												qSR.splice(index,1);
											}
											props.setAttributes({ selectedIDS: qSR });
											
											let query = getQuery('?include=' + qSR.join(',') + '&orderby=include');
											if ( qSR.length > 0 ) {
												props.setAttributes({queryCategories: query});
											} else {
												props.setAttributes({queryCategories: '' });
											}
											apiFetch({ path: query }).then(function (categories) {
												props.setAttributes({ querySearchSelected: categories});
											});
										},
									},
								),
								categories[i].name.replace(/&amp;/g, '&'),
								el('span',{ className: 'dashicons dashicons-yes'}),
								el('span',{ className: 'dashicons dashicons-no-alt'}),
							),
						)
					);
				}
				return categoryElements;
			}

			function renderSearchSelected() {
				let categoryElements = [];
				let i;

				let categories = attributes.querySearchSelected;
				if ( attributes.selectedIDS.length < 1 && categories.length > 0) {
					let bugFixer = [];
					for ( let i = 0; i < categories.length; i++ ) {
						bugFixer.push(categories[i].id);
					}
					props.setAttributes({ selectedIDS: bugFixer});
				}

				for ( let i = 0; i < categories.length; i++ ) {
					let img ='';
					if ( categories[i].image !== null && categories[i].image.src != '' ) {
						img = el('span', { className: 'img-wrapper', dangerouslySetInnerHTML: { __html: '<span class="img" style="background-image: url(\''+categories[i].image.src+'\')"></span>'}});
					} else {
						img = el('span', { className: 'img-wrapper', dangerouslySetInnerHTML: { __html: '<span class="img" style="background-image: url(\''+getbowtied_pbw.woo_placeholder_image+'\')"></span>'}});
					}
					categoryElements.push(
						el(
							'span', 
							{
								key 	 : 'item-' + categories[i].id,
								className:'single-result', 
								title: categories[i].name.replace(/&amp;/g, '&'),
							}, 
							img, 
							el(
								'label', 
								{
									className: 'title-wrapper'
								},
								el(
									'input',
									{
										type: 'checkbox',
										value: i,
										onChange: function onChange(evt) {
											let _this = evt.target;

											
											let qSS = attributes.selectedIDS;
											let index = qSS.indexOf(categories[evt.target.value].id);
											if (index != -1) {
												qSS.splice(index,1);
											}
											props.setAttributes({ selectedIDS: qSS });
											
											let query = getQuery('?include=' + qSS.join(',') + '&orderby=include');
											if ( qSS.length > 0 ) {
												props.setAttributes({queryCategories: query});
											} else {
												props.setAttributes({queryCategories: ''});
											}
											apiFetch({ path: query }).then(function (categories) {
												props.setAttributes({ querySearchSelected: categories});
											});
										},
									},
								),
								categories[i].name.replace(/&amp;/g, '&'),
								el('span',{ className: 'dashicons dashicons-no-alt'})
							),
						)
					);
				}
				return categoryElements;
			}

		//==============================================================================
		//	Main controls 
		//==============================================================================
			return [
				el(
					InspectorControls,
					{
						key: 'categories-main-inspector',
					},
					el(
						'div',
						{
							className: 'main-inspector-wrapper',
						},
						el(
							SelectControl,
							{
								key: 'query-panel-select',
								label: i18n.__( 'Source:', 'shopkeeper-extender' ),
								value: attributes.queryDisplayType,
								options: [{
									label: i18n.__( 'Manually pick', 'shopkeeper-extender' ),
									value: 'specific'
								}, {
									label: i18n.__( 'All Categories', 'shopkeeper-extender' ),
									value: 'all_categories'
								}],
								onChange: function onChange(value) {
									return props.setAttributes({ queryDisplayType: value });
								}
							}
						),
					/* Pick specific producs */
						attributes.queryDisplayType === 'specific' && el(
							'div',
							{
								className: 'products-ajax-search-wrapper',
							},
							el(
								TextControl,
								{
									key: 'query-panel-string',
			          				type: 'search',
			          				className: 'products-ajax-search',
			          				value: attributes.querySearchString,
			          				placeholder: i18n.__( 'Search for categories to display', 'shopkeeper-extender' ),
			          				onChange: function( newQuery ) {
			          					props.setAttributes({ querySearchString: newQuery});
			          					if (newQuery.length < 3) return;

								        let query = getQuery('?per_page=10&search=' + newQuery);
								        apiFetch({ path: query }).then(function (categories) {
								        	if ( categories.length == 0) {
								        		props.setAttributes({ querySearchNoResults: true});
								        	} else {
								        		props.setAttributes({ querySearchNoResults: false});
								        	}
											props.setAttributes({ querySearchResults: categories});
										});

									},
								},
							),
						),
						attributes.queryDisplayType === 'specific' && attributes.querySearchString != '' && el(
							'div',
							{ 
								className: 'products-ajax-search-results',
							},
							renderSearchResults(),
						),
						attributes.queryDisplayType === 'specific' && attributes.querySearchSelected.length > 0 && el(
							'div',
							{
								className: 'products-selected-results-wrapper',
							},
							el(
								'label',
								{},
								i18n.__( 'Selected Products:', 'shopkeeper-extender' ),
							),
							el(
								'div',
								{
									className: 'products-selected-results',
								},
								renderSearchSelected(),
							),
						),
						attributes.queryDisplayType === 'all_categories' && [
						el(
							SelectControl,
							{
								key: 'categories-grid-order-by',
								options:
									[
										{ value: 'menu_order',  label: i18n.__('Menu Order', 'shopkeeper-extender' ) },
										{ value: 'title_asc',   label: i18n.__( 'Alphabetical Ascending', 'shopkeeper-extender' ) },
										{ value: 'title_desc',  label: i18n.__( 'Alphabetical Descending', 'shopkeeper-extender' ) },
									],
	              				label: i18n.__( 'Order By', 'shopkeeper-extender' ),
	              				value: attributes.orderby,
	              				onChange: function( value ) {
	              					props.setAttributes( { orderby: value } );
								},
							}
						),
						el(
							TextControl,
							{
								key: 'categories-grid-display-number',
	              				label: i18n.__( 'How many product categories to display?', 'shopkeeper-extender' ),
	              				type: 'number',
	              				value: attributes.limit,
	              				onChange: function( value ) {
	              					props.setAttributes( { limit: value } );
								},
							},
						),
						el(
							ToggleControl,
							{
								id: "categories-grid-display",
								key: 'categories-grid-display',
	              				label: i18n.__( 'Parent Categories Only', 'shopkeeper-extender' ),
	              				checked: attributes.parentOnly,
	              				onChange: function( value ) {
		              				props.setAttributes( { parentOnly: value } );
								},
							}
						),
						el(
							ToggleControl,
							{
								key: "categories-grid-hide-empty",
	              				label: i18n.__( 'Hide Empty', 'shopkeeper-extender' ),
	              				checked: attributes.hideEmpty,
	              				onChange: function( value ) {
	              					props.setAttributes( { hideEmpty: value } );
								},
							}
						),
					],
					/* All products */

					/* Load all products */
						el(
							'button',
							{
								className: 'render-results components-button is-button is-default is-primary is-large ' + _isLoading(),
								disabled: _isDonePossible(),
								onClick: function onChange(e) {
									props.setAttributes({ isLoading: true });
									_destroyTempAtts();
									getResult();
								},
							},
							_isLoadingText(),
						),
					),
					el( 'hr', {} ),
					el(
						ToggleControl,
						{
							key: "categories-grid-product-count",
              				label: i18n.__( 'Product Count', 'shopkeeper-extender' ),
              				checked: attributes.productCount,
              				onChange: function( value ) {
              					props.setAttributes({ productCount: value });
							},
						}
					),
				),
				el(
					'div',
					{
						key: 		'gbt_18_sk_categories_grid',
						className: 	'gbt_18_sk_categories_grid'
					},
					attributes.queryDisplayType == 'all_categories' && attributes.doneFirstPostsLoad === false && getResult(),
					renderResults(),
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
	window.wp.element,
	jQuery
);