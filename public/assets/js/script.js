// 'use strict'
// var imgLink = document.querySelector('.img-box'),
// 	imgUpload = document.querySelector('.img-upload'),
// 	img = document.querySelector('.img-container > img');


// imgLink.addEventListener('click', function(e){
// 	e.preventDefault();
// 	img.style.display = 'none';
// 	e.target.style.display = 'none';
// 	imgUpload.style.display = 'block';
// });

$(function(){
	'use strict'
	$('.img-box').click(function(e){
		e.preventDefault();
		$('#img-field').hide();
		$('#img-upload').show();
	})
})