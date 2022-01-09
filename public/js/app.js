(function($){

	/*Move cusor to the end of input*/
	$.fn.moveCursorToEnd = function(){
		var originalValue = this.val();
		this.val('');
		this.blur().focus().val(originalValue);
		//this.focus();
	};

	/*ADD FORM, EDIT FORM*/
	$('#add-form, #edit-form').find('input[name=title]').moveCursorToEnd();

	/*DELETE FORM*/
	$('#delete-form').on('submit', function(){
		return confirm('Naozaj zmazať?');
	});

	/*Hide alerts*/
	$('.alert').find('.close').on('click', function(){
		$(this).parent().fadeOut();
	});

}(jQuery));