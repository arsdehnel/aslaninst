var setColor = function( $element ) {
  var $target = $($element.attr('data-selector'))
  var selValue = $element.val()
  $target.css('background',selValue);
  $element.parent().children('.color-value').text(selValue);
}

$(function(){
	$.get('/wp-content/themes/aslan2014/includes/client-side-color-picker/widget.html',function(data){
		$('body').append(data);
		$('.element-selector :input').each(function(){
	  		setColor( $(this) );
		})
	})

	$('body').on('change','.element-selector :input',function(){
	  setColor( $(this) );
	})

})
