$(function(){
	$(document).on('click','a[data-toggle=modal]', function() {

			event.preventDefault();
			var $modal=$($(this).data('target'));

			$('.modal-body',$modal).empty();
			$('.modal-header',$modal).empty();
			$modal.show();
			$('.modal-body',$modal).load($(this).attr('href'));
			$('.modal-header',$modal).append($(this).attr('title'));
	});

	$('.category').tree({
		expanded: 'li.expanded'
	});
	
	$('#dataTable').on('pjax:end',   function() { 
		
		//$.pjax.reload({
		//	container : '#dataTable', timeout: '5000',
		//});	
		//$.pjax.reload({
		//	container : '#driverPjax', timeout: '5000',
		// }); 
		$('.category').tree({
			expanded: 'li.expanded'
		});	  
	});
	
	
});


