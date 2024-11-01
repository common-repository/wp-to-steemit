(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    // function loading() {
    //     $('.pts_steemit_btn').text('Syncing to steemit');
    // }
    //
    // function stopLoading() {
    //     $('.pts_steemit_btn').text('Steemit');
    // }


    // function syncPostToSteemit() {
    //     var options = ajax_object.pst_options;
    //     var wif = steem.auth.toWif(options.pst_steemit_username, options.pst_steemit_password, 'posting');
    //     var title = $('.pts_visible_title').text();
    //     var article = toMarkdown($('.pts_visible_content').html());
    //     var permLink = $('.pts_visible_perm_link').text();
    //
    //     console.log("Syncing to steam: ", title, article, permLink);
    //
    //     loading();
    //     steem.broadcast.comment(wif, '', 'steemjs', options.pst_steemit_username, permLink, title, article, {tags: ['steemjs', 'steem']}, function(err, result) {
		// 	stopLoading();
		// 	if(err) {
		// 		alert("There is something's wrong. Please check your steemit username and password.")
		// 	    console.error("Syncing steem error", err);
    //         } else {
    //             console.log("Syncing stem successfully", result);
    //         }
		// });
    // }
	//Issue: https://github.com/steemit/steem-js/issues/313
    steem.api.setOptions({ url: 'https://api.steemit.com'});

	$( window ).load(function() {

        $('.pts_steemit_btn').click(function(evt) {
            evt.preventDefault();
            $('#24039_reactModal').click();
            // syncPostToSteemit();
        });
	});


})( jQuery );
