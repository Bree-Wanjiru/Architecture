( function( api ) {
	// Extends our custom "real-estate-broker" section.
	api.sectionConstructor['real-estate-broker'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

