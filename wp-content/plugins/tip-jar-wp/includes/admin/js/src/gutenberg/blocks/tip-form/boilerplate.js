/*
* Tip Jar WP
* https://www.tipjarwp.com
*
* Licensed under the GPL license.
*
* Author: Tip Jar WP
* Version: 1.0
* Date: January 11, 2018
*/

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const RichText = wp.editor.RichText;
import AttributeReciever from './tip-form.js'

class Icon extends React.Component {

	render() {
		return (
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enableBackground="new 0 0 1000 1000" fill="#f9b429">
			<path d="M797.669,371.752l-19.702-55.833c-1.521-4.297-2.181-8.854-1.938-13.406l0.018-0.334l-0.125-44.222h12.02
			c6.924,0,12.537-5.613,12.537-12.537c0-6.924-5.613-12.538-12.537-12.538h-12.09l-0.086-30.089h12.176
			c6.924,0,12.537-5.613,12.537-12.537s-5.613-12.537-12.537-12.537h-12.245l-0.099-34.784c-0.064-14.734-12.012-26.653-26.746-26.681
			H251.158c-14.733,0.03-26.68,11.948-26.746,26.681l-0.099,34.784h-12.253c-6.924,0-12.538,5.613-12.538,12.537
			s5.613,12.537,12.538,12.537l0,0h12.174l-0.085,30.089h-12.089c-6.924,0-12.538,5.613-12.538,12.538
			c0,6.924,5.613,12.537,12.538,12.537l0,0h12.019l-0.124,44.222l0.017,0.334c0.242,4.553-0.417,9.11-1.939,13.408l-19.702,55.832
			c-23.033,65.168-34.787,133.787-34.756,202.907v171.176c0.085,76.13,61.78,137.825,137.91,137.91h389.031
			c76.13-0.085,137.824-61.78,137.91-137.91V574.659C832.456,505.539,820.702,436.921,797.669,371.752z M249.478,143.005
			c0.007-0.92,0.751-1.665,1.672-1.671h497.692c0.921,0.006,1.666,0.751,1.672,1.671l0.099,34.714H249.379L249.478,143.005z
			M249.311,202.793h501.38l0.085,30.089H249.224L249.311,202.793z M807.351,745.842c-0.069,62.288-50.547,112.766-112.835,112.835
			H305.485c-62.289-0.069-112.766-50.547-112.836-112.835V574.666c-0.029-66.277,11.241-132.073,33.326-194.562l19.702-55.823
			c2.577-7.275,3.716-14.982,3.355-22.693l0.122-43.629h501.692l0.124,43.629c-0.362,7.71,0.776,15.417,3.354,22.693l19.702,55.823
			c22.084,62.489,33.354,128.285,33.325,194.562V745.842z"/>
			<path d="M500,390.853L500,390.853c-79.742-0.001-144.387,64.643-144.388,144.384c0,0.002,0,0.003,0,0.004l0,0
			c0,79.742,64.643,144.387,144.384,144.388c0.002,0,0.003,0,0.004,0l0,0c79.743,0.001,144.388-64.642,144.388-144.385
			c0-0.001,0-0.002,0-0.003l0,0c0.001-79.742-64.642-144.387-144.385-144.388C500.003,390.853,500.001,390.853,500,390.853z
			M518.89,618.042c-5.441,2.061-6.411,4.122-6.37,7.663c0.018,0.275,0.042,0.555,0.071,0.835c0.081,0.744,0.146,1.737,0.168,2.811
			c0.261,4.611-0.229,7.92-1.462,9.724c-3.593,5.267-7.729,6.466-10.568,6.547h-0.194c-4.691,0-10.85-4.636-12.088-9.148
			c-0.59-2.147-1.07-4.024-1.493-5.684c-2.565-10.029-2.718-10.622-13.707-16.676l-0.265-0.167
			c-12.098-8.125-19.371-19.925-21.617-35.071c-0.185-1.218-0.291-2.446-0.319-3.678c-0.722-11.382,6.261-14.181,10.497-14.84
			c11.959-1.823,13.875,9.811,14.516,13.642c2.46,14.76,12.35,22.93,26.451,21.912c12.242-1.132,21.583-11.443,21.501-23.738
			c-0.408-12.92-9.737-21.837-24.349-23.149c-23.975-2.152-41.046-15.179-46.838-35.737c-1.253-4.433-1.898-9.015-1.921-13.622
			c-0.771-20.113,11.306-38.5,30.071-45.782c5.39-2.111,6.353-4.199,6.302-7.784c-0.019-0.276-0.042-0.561-0.071-0.852
			c-0.079-0.76-0.129-1.672-0.154-2.595c-0.08-1.409-0.09-3.297-0.025-4.603c-0.064-3.077,0.818-6.101,2.531-8.659
			c2.297-3.51,7.476-4.513,9.891-4.539c2.807,0.095,5.439,1.381,7.24,3.535c2.578,2.721,4.103,6.271,4.302,10.014
			c0.057,0.507,0.062,1.02,0.017,1.528c-0.092,0.983-0.126,1.972-0.104,2.96c0.426,6.077,3.644,9.545,12.74,13.573
			c13.743,6.083,22.35,18.723,24.894,36.57c0.183,1.247,0.286,2.503,0.312,3.763c0.747,11.339-6.256,14.119-10.496,14.753
			c-11.822,1.759-13.894-9.863-14.568-13.685c-2.435-13.759-10.514-21.541-22.748-21.909c-13.453-0.431-24.263,9.07-25.195,22.046
			c-0.05,0.71-0.055,1.408-0.047,2.104c0.689,11.812,9.842,21.383,21.611,22.601c1.422,0.183,2.854,0.309,4.286,0.438
			c2.701,0.19,5.39,0.541,8.051,1.048c21.062,4.197,36.924,21.644,39.101,43.01c0.134,1.348,0.208,2.725,0.228,4.21
			C550.058,591.817,537.914,610.583,518.89,618.042L518.89,618.042z"/>
			</svg>
		);
	}
}

registerBlockType( 'tipjarwp/tip-form', {
	title: __( 'Tip Jar WP - Payment Form' ),
	icon: <Icon />,
	category: 'common',

	// Note that these values are only used when the block is first added. Otherwise, these are ignored and the block pulls from the post_content.
	attributes: tip_jar_wp_gutenberg_vars.tip_jar_wp_block_default_json,

	// This function is passed into the context, which makes it available in all child components.
	// This allows any child component to update the "state", aka "attributes" in Gutenberg. Attributes are saved....where?
	edit( props ) {

		// We will store the unique attibutes for this block in a custom table.
		// So right now, we will simply create a row in the custom table for this block's attributes, and populate it with the attributes when the block is viewed.
		// That takes place in the server side render function (tip_jar_wp_tip_form_block_server_side_render)
		var temp_json = JSON.parse( props.attributes.json );
		if ( ! temp_json.id ) {

			tip_jar_wp_create_and_get_form_id().then( ( tip_form_id ) => {

				temp_json.id = tip_form_id;

				props.setAttributes( {
					json: JSON.stringify( temp_json ),
				} );
			} );
		}

		const changeAttributes = (attributes) => {

			return new Promise( (resolve, reject) => {

				// Update the attributes, then resolve the promise
				props.setAttributes( {
					json: JSON.stringify( attributes ),
				} );

				// Listen for changes to this block
				wp.data.subscribe( () => {

					// Get the updated state of this block
					const this_block = wp.data.select( 'core/block-editor' ).getBlock( props.clientId );

					if ( this_block && this_block.attributes ) {
						// console.log( 'saving props...' );
						// console.log( JSON.parse( this_block.attributes.json ) );
						resolve( this_block.attributes );
					} else {
						reject();
					}

				} );

			});
		}

		// Make sure value in the attributes exists in the JSON. This covers situations where new variables might have been added after this block was saved to the post_content.
		var block_attributes   = JSON.parse( props.attributes.json );
		var default_attributes = JSON.parse( tip_jar_wp_gutenberg_vars.tip_jar_wp_block_default_json.json.default );

		for (var string in default_attributes['strings']) {
			if ( ! block_attributes['strings'][string] ) {
				block_attributes['strings'][string] = default_attributes['strings'][string];
			}
		}

		for (var input_field_instruction in default_attributes['strings']['input_field_instructions']) {
			if ( ! block_attributes['strings']['input_field_instructions'][input_field_instruction] ) {
				block_attributes['strings']['input_field_instructions'][input_field_instruction] = default_attributes['strings']['input_field_instructions'][input_field_instruction];
			}
		}

		return (
				<AttributeReciever
					attributes={ block_attributes }
					changeAttributes={ changeAttributes }
				/>
		);
	},

	save( props ) {
		return null;
	}

} );

// This will send a fetch call to the server to generate a row in the forms table.
function tip_jar_wp_create_and_get_form_id() {

	return new Promise( (resolve, reject) => {

		var postData = new FormData();
		postData.append('action', 'tip_jar_wp_create_or_update_form' );
		postData.append('form_id', false ); // This is false so that it generates a new form.
		postData.append('state', false );
		postData.append('tip_jar_wp_create_or_update_form_nonce', tip_jar_wp_gutenberg_vars.create_form_nonce);

		fetch( tip_jar_wp_gutenberg_vars.create_form_endpoint, {
			method: "POST",
			mode: "same-origin",
			credentials: "same-origin",
			body: postData
		} ).then(
			function( response ) {
				if ( response.status !== 200 ) {
					console.log('Looks like there was a problem. Status Code: ' + response.status);
					reject('unable_to_create_form');
					return;
				}

				// Examine the text in the response
				response.json().then(
					function( data ) {
						if ( data.success ) {
							resolve( data.form_id );
							return data.form_id;
						} else {
							console.log('Looks like there was a problem: ' + data);
							reject('unable_to_create_form');
							return;
						}
					}
				).catch(
					function( err ) {
						console.log('Fetch Error: ', err);
						reject('unable_to_create_form');
						return;
					}
				);
			}
		).catch(
			function( err ) {
				console.log('Fetch Error: ', err);
				reject('unable_to_create_form');
				return;
			}
		);

	} );

}
