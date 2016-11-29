(function ($, Drupal, window, document, undefined) {



})(jQuery, Drupal, this, this.document);

(function($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {
  
  
		$('.active').addClass('uk-active');  
	  	$('form').addClass('uk-form');
        $('#edit-actions input').addClass('uk-button uk-margin-right');
      $('#edit-actions input#edit-submit').addClass('uk-button-primary');


	}
};
})(jQuery);