<?php

/**
 * Fires when the comment status is in transition from one specific status to another.
 *
 * The dynamic portions of the hook name, `$old_status`, and `$new_status`,
 * refer to the old and new comment statuses, respectively.
 *
 * Possible hook names include:
 *
 *  - `comment_unapproved_to_approved`
 *  - `comment_spam_to_approved`
 *  - `comment_approved_to_unapproved`
 *  - `comment_spam_to_unapproved`
 *  - `comment_unapproved_to_spam`
 *  - `comment_approved_to_spam`
 *
 * @since 2.7.0
 *
 * @param WP_Comment $comment Comment object.
 */
 


 function action_comment_unapproved_to_approved( $comment ) {    
    // When isset
    if ( isset ( $comment->comment_author_email ) ) {
        // Get author email
        $author_email = $comment->comment_author_email;
        $author_name = $comment->comment_author;
            
        // Is email
        if ( is_email( $author_email ) ) {          
            // Get an emty instance of the WC_Coupon Object
            $coupon = new WC_Coupon();
    
            // Generate a non existing coupon code name
            $coupon_code = random_int( 100000, 999999 ); // OR generate_coupon_code();
            $discount_type = 'percent';
            $coupon_amount = '20'; // Discount amount

            // Set the necessary coupon data (since WC 3+)
            $coupon->set_code( $coupon_code );
            $coupon->set_discount_type( $discount_type );
            $coupon->set_amount( $coupon_amount );
            $coupon->set_individual_use( true );
            $coupon->set_usage_limit( 1 ); // how many time they can use
            $coupon->set_email_restrictions( array( $author_email ) );
            $coupon->set_date_expires( strtotime( '+14 days' ) ); // available days
            $coupon->set_free_shipping( true );

            // Create, publish and save coupon (data)
            $coupon->save();
            
            $subject = sprintf( __('Your Discount Code : "%s"'), $coupon_code );
           
            $content = '<img src="https://yourwebiste.com/logo.png" width="150"><br><br>Dear ' . $author_name . '<br><br>' .  'Thanks your review. <br> You can use your this coupon code for next order :' . '<br><br>' . '<b>' . $coupon_code . '</b><br><p><em>* Only available 14 days.</em></p>' ;
           
            $headers = array('Content-Type: text/html; charset=UTF-8');

            wp_mail( $author_email, $subject, $content, $headers );
        }
    }

}
add_action( 'comment_unapproved_to_approved', 'action_comment_unapproved_to_approved', 10, 1 );