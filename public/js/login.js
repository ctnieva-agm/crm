	$(function(){
		$('.signIn').click(function(){
			loginCrm();
		});
		$('body').keypress(function(e)
		{
			var pressedKey = e.keyCode||e.which;
			if(pressedKey == 13)
			{
				loginCrm();
				return false;
				e.preventDefault();
			}
		});
	})
	
	function loginCrm()
	{
		let form = $('form').serialize();
		$('.loadingBackground').css('display','block');
		// $('.main').css('display','none');

		$.post('/login', form)
			.done(function(data){
				$('.loadingBackground').css('display','none');
				window.location = '/';
			})
			.fail(function(data){
				console.log(data);
				alert('failed!');
				// window.location = '/login';
			})
	}