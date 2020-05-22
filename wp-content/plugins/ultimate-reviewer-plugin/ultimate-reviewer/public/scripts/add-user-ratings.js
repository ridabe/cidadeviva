/**
 * Cookie functions
 *
 */	
// Create cookie function
function createCookie( name, value, days ) {
	var expires = '';
	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
	 	expires = '; expires=' + date.toGMTString();
	} else {
		expires = '';
	}
	document.cookie = name + '=' + value + expires + '; path=/';
}

// Read cookie function
function readCookie( name ) {
	var nameEQ = name + '=';
	var ca = document.cookie.split( ';' );
	for ( var i = 0; i < ca.length; i++ ) {
		var c = ca[i];
		while ( c.charAt(0) == ' ' ) {
			c = c.substring( 1, c.length );
		}
		if ( c.indexOf( nameEQ ) == 0 ) {
			return c.substring( nameEQ.length, c.length );
		}
	}
	return null;
}

/**
 * Submit ratings function
 *
 */	
function submitRatings( element ) {

	var hasError = '',
		parentContainer = element,
		criterionContainer = parentContainer.find( '.gpur-criterion' ),
		inputField = parentContainer.find( '.gpur-criterion .gpur-user-rating' ),
		nonce = inputField.data( 'nonce' ),
		//weight = inputField.data( 'weight' ),
		minRating = inputField.data( 'min-rating' ),
		maxRating = inputField.data( 'stop' ),
		count = 1,
		eachRatingValue = 0,
		ratingValue = 0,
		multiRatingValues = [];

	// Check if item has been rated
	if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
		if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.userRating ) {
			hasError = 'yes';
		}
	}

	// Proceed, if user can rate
	if ( hasError != 'yes' ) {

		// Loop through each multi rating	
		criterionContainer.each( function( index ) {

			// Get counter value
			count = parseInt( index + 1 );

			var inputField = jQuery( this ).find( '.gpur-user-rating' ),
				weight = inputField.data( 'weight' );

			// Get each multi rating
			if ( weight !== undefined && weight !== '' ) {
				eachRatingValue += parseFloat( inputField.val() * weight );
			} else {
				eachRatingValue += parseFloat( inputField.val() );
			}
			multiRatingValues[index] = inputField.val();

			// Set rating to zero if submitted and left empty
			if ( multiRatingValues[index] === '' && minRating === 0 ) {		
				multiRatingValues[index] = 0;		
			}

			// Prevent rating lower than minimum
			if ( multiRatingValues[index] < minRating ) {
				multiRatingValues[index] = 0;		
			}

			// Prevent rating higher than maximum
			if ( multiRatingValues[index] > maxRating ) {
				multiRatingValues[index] = maxRating;
			}
						
			// Final check to make sure a valid rating is being submitted
			if ( ! jQuery.isNumeric( multiRatingValues[index] ) ) {
				hasError = 'yes';
				return false;
			}
			
		});

		// Get an average of all multi ratings 
		var avgRatingValue = parseFloat( eachRatingValue / count );
			ratingValue = Math.round( avgRatingValue * 10 ) / 10;

	}

	// Loading effect			
	parentContainer.find( '.gpur-success' ).hide();	
	parentContainer.find( '.gp-comment-error' ).hide();
	if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
		if ( parentContainer.hasClass( 'gpur-unrated' ) ) {
			parentContainer.addClass( 'gpur-loading' );
		}	
	}
	
	// Proceed, if rating data is valid
	if ( hasError != 'yes' ) {
			
		// Prevent another rating being sent
		inputField.attr( 'data-readonly', '' );
		parentContainer.addClass( 'gpur-rated' ).removeClass( 'gpur-unrated' );
			
		// Collect data ready for sending to PHP	
		var data = {
			action: 'gpur_save_rating',
			postID: gpur_add_user_ratings.post_id,
			nonce: nonce,
			//weight: weight,
			maxRating: maxRating,
			minRating: minRating,
			ratingValue: ratingValue,
			multiRatingValues: multiRatingValues
		};

		// Send rating data via ajax to PHP
		jQuery.post( gpur_add_user_ratings.ajax_url, data, function() {

			// Create cookies for logged out users
			if ( ! jQuery( 'body' ).hasClass( 'logged-in' ) ) {
				if ( multiRatingValues != '' ) {
					createCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id, multiRatingValues, 900 );
				} else {
					createCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id, ratingValue, 900 );
				}
			}
			
		});

		// Dynamically update average user rating and user votes
		var avgUserRating = parentContainer.find( '.gpur-average-data .gpur-rating-value' ),
			yourRating = parseInt( parentContainer.find( '.gpur-user-rating' ).val() ),
			userSum = parseInt( gpur_add_user_ratings.user_sum ),
			newUserVotes = parseInt( gpur_add_user_ratings.user_votes ) + 1,
			userVotesNumberText = parentContainer.find( '.gpur-user-votes-number' ),
			userVotesText = parentContainer.find( '.gpur-user-votes-text' );

		// Update user votes text
		userVotesNumberText = userVotesNumberText.text( newUserVotes );
		if ( newUserVotes == 1 ) {
			userVotesText = userVotesText.text( 'vote' );
		} else {
			userVotesText = userVotesText.text( 'votes' );
		}
			
		// Update average user rating
		if ( userSum > 0 ) {
			var newRating = ( userSum + yourRating ) / newUserVotes;
		} else {
			var newRating = yourRating;
		}	
		avgUserRating = avgUserRating.text( newRating.toPrecision( 2 ) );
				
		// Show success messages
		setTimeout( function() {
			parentContainer.find( '.gpur-submit-rating' ).fadeOut();
			parentContainer.removeClass( 'gpur-loading' );
			parentContainer.find( '.gpur-success' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
		}, 800 );
				   
	} else {

		// Show error messages
		setTimeout( function() {
			parentContainer.removeClass( 'gpur-loading' );
			parentContainer.find( '.gp-comment-error' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
		}, 800 );
		
		hasError = '';

	}		

}
	
jQuery( function( $ ) {

  'use strict';

	var hasError = '';

	/**
	 * Set width for rating bar sections
	 *
	 */	
	var criterionWrapper = $( '.gpur-style-bars .gpur-criterion' );
	criterionWrapper.each( function() {
		var eachCriterionWrapper = $( this ),
			barCount = $( this ).find( '.gpur-user-rating' ).data( 'stop' ),
			barWidth = ( 100 / barCount ) + '%';
			eachCriterionWrapper.find( '.rating-symbol' ).css( 'width', barWidth );	
	});
			
	/**
	 * Comment form character limits
	 *
	 */	
	 	
	// Review title character limit message
	$( '#gpur-comment-form-title' ).keyup( function() {
		var textlen = gpur_add_user_ratings.review_title_limit - $( this ).val().length;
		$( this ).next( '.gpur-character-limit-message' ).find( '.gpur-characters-remaining' ).text( textlen );
	});
	
	// Review text character limit message
	$( 'textarea#comment' ).keyup( function() {
		var textlen = gpur_add_user_ratings.review_text_limit - $( this ).val().length;
		$( this ).next( '.gpur-character-limit-message' ).find( '.gpur-characters-remaining' ).text( textlen );
	});
		
	/**
	 * Dynamically update rating value when hovering
	 *
	 */			
	$( document ).on( 'rating.rateenter', '.gpur-add-user-ratings-wrapper .rating-symbol', function( e, rate ) {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' );	

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}

		if ( hasError != 'yes' ) {

			// Set rating to zero if submitted and left empty
			if ( rate === '' && inputField.data( 'min-rating' ) === 0 ) {		
				rate = 0;		
			}
						
			// Prevent rating lower than minimum
			if ( rate < inputField.data( 'min-rating' ) ) {
				rate = inputField.data( 'min-rating' );
			}

			// Prevent rating higher than maximum
			if ( rate > inputField.data( 'stop' ) ) {
				rate = inputField.data( 'stop' );
			}
	
			el.parent().parent().find( '.gpur-ind-user-rating .gpur-rating-value' ).text( parseFloat( rate ) );
			
		}
					
	});
	
	$( document ).on( 'rating.rateleave', '.gpur-add-user-ratings-wrapper .rating-symbol', function() {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' );	

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}
			
		if ( hasError != 'yes' ) {

			if ( inputField.val() === 0 ) {
				el.parent().parent().find( '.gpur-ind-user-rating .gpur-rating-value' ).text( 0 );
			} else {
				el.parent().parent().find( '.gpur-ind-user-rating .gpur-rating-value' ).text( inputField.val() );
			}
		
		}
		
	});

	/**
	 * Dynamically update your multi ratings when clicking
	 *
	 */	
	$( '.gpur-add-user-ratings-wrapper.gpur-multi-rating .rating-symbol' ).on( 'click', function ( e ) {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' ),
			ratingText = el.parent().parent().find( '.gpur-ind-user-rating .gpur-rating-value' );

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}
		
		if ( hasError != 'yes' ) {						
			ratingText.text( parseFloat( inputField.val() ) );		
		}
					
	});

	
	$( document ).on( 'click', '.gpur-in-comment.gpur-add-user-ratings-wrapper.gpur-no-submit-button .rating-symbol', function() {
		var myRating = $( this ).closest( '.gpur-add-user-ratings-wrapper' ).find( 'input.rating' ).val();
		localStorage.setItem( 'myRating', myRating );
	});
		
	/**
	 * Submitting comment form
	 *
	 */
	$( 'body' ).on( 'submit', '.comments-area #commentform', function( e ) {

		e.preventDefault();

		var commentform = $( this ),
			commentArea = $( this ).closest( '#comments' ),
			action = commentform.attr( 'action' ),
			formData = commentform.serializeArray(),
			nameField = commentform.find( '#author' ),
			emailField = commentform.find( '#email' ),
			titleField = commentform.find( '#gpur-comment-form-title' ),
			inputField = commentform.find( '.gpur-user-rating' ),
			commentField = commentform.find( '#comment' ),
			hasError = '';

		// Loading effect					
		commentform.find( '.gpur-success' ).hide();
		commentArea.find( '.gp-comment-error' ).hide();	
		nameField.removeClass( 'gpur-required' );	
		emailField.removeClass( 'gpur-required' );
		titleField.removeClass( 'gpur-required' );	
		inputField.removeClass( 'gpur-required' );	
		commentField.removeClass( 'gpur-required' );	
		commentform.addClass( 'gpur-loading' );
				
		// Check if required fields are empty
		if ( nameField.val() === '' && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			nameField.addClass( 'gpur-required' );
			hasError = 'yes';
		}

		if ( emailField.val() === '' && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			emailField.addClass( 'gpur-required' );
			hasError = 'yes';
		}
				
		if ( gpur_add_user_ratings.review_title === 'enabled' && titleField.val() === '' && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			titleField.addClass( 'gpur-required' );
			hasError = 'yes';
		}
		
		if ( inputField.length && ( inputField.val() == 0 && gpur_add_user_ratings.comment_form_min_rating > 0 ) && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			inputField.parent().parent().addClass( 'gpur-required' );
			hasError = 'yes';
		}
		
		if ( commentField.val() === '' ) {			
			commentField.addClass( 'gpur-required' );
			hasError = 'yes';
		}

		if ( hasError === 'yes' ) {

			// Show error messages
			setTimeout( function() {
				commentform.removeClass( 'gpur-loading' );
				commentArea.find( '.gpur-success' ).hide();
				commentArea.find( '.gp-comment-error' ).text( gpur_add_user_ratings.comment_form_single_error_message ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
			}, 800 );
											
		} else {
		
			// Submitting comment
			$.ajax({
				type: 'post',
				url: action,
				clearForm: true,
				data: formData,
				beforeSend: function() {
				},
				success: function( data, textStatus ) {				

					if ( textStatus === 'success') {
					
						// Prevent another rating being sent						
						commentform.find( 'input, textarea' ).attr( 'disabled', true );
						inputField.attr( 'data-readonly', '' );

						// Reload comment list from ajax data
						commentArea.find( '.comment-list' ).replaceWith( $( data ).find( '.comments-area .comment-list' ) );
						
						// Reload comment form from ajax data
						if ( commentArea.find( '#wp-temp-form-div' ).length ) { 
							// If reply comment form
							commentArea.find( '#wp-temp-form-div' ).replaceWith( $( data ).find( '.comments-area #respond' ) );
						} else { 
							// If main comment form						
							commentArea.find( '#respond' ).replaceWith( $( data ).find( '.comments-area #respond' ) );
						}
				
						// Reload ratings script
						commentArea.find( 'input.rating' ).rating();
						
						// Add loading class to comment form
						commentArea.find( '#respond' ).addClass( 'gpur-loading' );
						
						// Hide already voted messages from showing
						commentArea.find( '.gpur-already-voted' ).hide();
						
						// Dynamically update data
						
						// If it's a not a normal reply comment, proceed to update comment summary breakdown
						if ( ! commentform.closest( 'li' ).hasClass( 'gp-normal-reply' ) ) {
						
							var summaryContainer = $( '.gpur-rating-summary' ),
								myRating = localStorage.getItem( 'myRating' ) ? parseInt( localStorage.getItem( 'myRating' ) ) : '';

							// Update user sum
							var newUserSum = ( parseInt( summaryContainer.attr( 'data-user-sum' ) ) > 0 ) ? parseInt( summaryContainer.attr( 'data-user-sum' ) ) + myRating : myRating;
							summaryContainer.attr( 'data-user-sum', newUserSum );
						
							// Update user votes
							var newUserVotes = ( parseInt( summaryContainer.attr( 'data-user-votes' ) ) > 0 ) ? parseInt( summaryContainer.attr( 'data-user-votes' ) ) + 1 : 1;
							summaryContainer.find( '.gpur-user-votes-number' ).text( newUserVotes );
							summaryContainer.attr( 'data-user-votes', newUserVotes );
							if ( newUserVotes == 1 ) {
								summaryContainer.find( '.gpur-user-votes-text' ).text( 'vote' );
							} else {
								summaryContainer.find( '.gpur-user-votes-text' ).text( 'votes' );
							}
						
							// Update average user rating
							var newAvgUserRating = newUserSum / newUserVotes;
							summaryContainer.find( '.gpur-rating-value' ).text( newAvgUserRating.toPrecision( gpur_add_user_ratings.comment_form_decimal_places ) );
						
							// Update rating summary stars
							$( '.gpur-rating-summary > .gpur-element-wrapper input.rating' ).rating( 'rate', newAvgUserRating.toPrecision( gpur_add_user_ratings.comment_form_decimal_places ) );
								
							// Update rating breakdown
							var fractions = ( 1 / gpur_add_user_ratings.comment_form_fractions );

							$( '.gpur-summary-entry' ).each( function( index ) {
						
								var summaryEntry = $( this ),
									summaryScore = parseInt( summaryEntry.find( '.gpur-rating-summary-score' ).text() );
						
								if ( myRating === summaryScore ) {
									var currentRatingCount = parseInt( summaryEntry.attr( 'data-rating-count' ) );
									currentRatingCount = currentRatingCount + 1;
									summaryEntry.attr( 'data-rating-count', currentRatingCount );
								} else {
									currentRatingCount = parseInt( summaryEntry.attr( 'data-rating-count' ) );
								}
							
								if ( currentRatingCount > 0 && newUserVotes > 0 ) {
									var percentage = Math.round( ( currentRatingCount / newUserVotes ) * 100 );	
								} else {
									percentage = 0;
								}
								summaryEntry.find( '.gpur-rating-summary-percentage' ).text( percentage + '%' );
				
								var ratingBreakdown = ( currentRatingCount > 0 && newUserVotes > 0 ) ? ( currentRatingCount / newUserVotes ) * gpur_add_user_ratings.comment_form_max_rating : 0;
					
								summaryEntry.find( 'input.rating' ).rating( 'rate', ratingBreakdown.toPrecision( gpur_add_user_ratings.comment_form_decimal_places ) );
					
							});
						
						}
						
						// Reload comments
						setTimeout( function() {
												
							// Hide comment form components
							if ( gpur_add_user_ratings.comment_rating_limit === 'one-rating-one-comment' ) {	
								commentArea.find( '#respond' ).hide();
							} else {
								commentArea.find( '.comment-form-rating' ).hide();
							}
							
							// Remove loading class from comment form
							commentArea.find( '#respond' ).removeClass( 'gpur-loading' );
						
							// Show success message
							commentArea.find( '.gpur-success' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 300 );
							
						}, 800 );
																
					}
									
				},
				error: function( xhr, textStatus, errorThrown ) {

					// Show error messages
					setTimeout( function() {
						commentform.removeClass( 'gpur-loading' );
						commentArea.find( '.gpur-success' ).hide();
						commentArea.find( '.gp-comment-error' ).text( gpur_add_user_ratings.comment_form_single_duplicate_comments ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
					}, 800 );
					
				}
			});
		
		}
				
		return false;
	});

	/**
	 * Submitting rating data when clicking rating icons
	 *
	 */		
	$( '.gpur-in-post.gpur-add-user-ratings-wrapper.gpur-no-submit-button .rating-symbol' ).on( 'click', function( e ) {
		submitRatings( $( this ).parent().parent().parent() );	
	});

	/**
	 * Submitting rating data when clicking submit button
	 *
	 */		
	$( '.gpur-has-submit-button .gpur-submit-rating' ).on( 'click', function( e ) {
		submitRatings( $( this ).parent() );
	});
	
	/**
	 * Remove review title and rating fields from normal reply comments
	 *
	 */		
	var commentTitleInput = '';
	var commentRatingInput = '';

	$( document ).on( 'click touchstart', '.gp-normal-reply a.comment-reply-link', function() {
		var commentLi = $( this ).closest( 'li' );
		commentTitleInput = commentLi.find( '.gpur-comment-form-title' ).children().detach();
		commentRatingInput = commentLi.find( '.gpur-add-user-ratings-wrapper' ).children().detach();
	});

	// Readd fields to main comment form when comment cancel link is clicked
	$( document ).on( 'click touchstart', 'a#cancel-comment-reply-link', function() {
		if ( '' !== commentTitleInput ) {
			commentTitleInput.appendTo( '.gpur-comment-form-title' );
		}
		if ( '' !== commentRatingInput ) {
			commentRatingInput.appendTo( '.gpur-add-user-ratings-wrapper' );
		}	
	});
								
});