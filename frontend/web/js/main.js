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
	
	$(document).on('click','.delete-tr', function() {
		$(this).parent().parent("tr").find('.product_count').val(0);
		$(this).parent().parent("tr").hide();
		
		refresh_order();
		return false;
	});
	
	$(document).on('change','#orders-data_start, #orders-data_finish', function() {
		
		data_start  = $('#orders-data_start').val();
		data_finish = $('#orders-data_finish').val();
		
		if ( data_start && data_finish ){
			$.get( '/ajax/get_order_days.php?data_start='+data_start+'&data_finish='+data_finish, function(data){
				$('#arenda_days').show().find('span').text(data);
				refresh_order();
			});
		}
		
		return false;
	});
	
	$(document).on('change','#orders-user_price', function() {
		
		if ( $(this).prop("checked") ){
			$('#orders-summ').prop('disabled',false);
		}
		else {
			$('#orders-summ').prop('disabled',true);
			var summ = $('#itog_all').find('span').text( );
			$('#orders-summ').val( summ );
		}
		
		
		return false;
	});

	$(document).on('change','.product_count', function() {
		
		if ( parseInt($(this).val()) > parseInt($(this).attr('max')) ){
			$(this).val( $(this).attr('max') );
		}
		
		price = $(this).parent().parent().find(".product_price").text();
		total_price = price * $(this).val();
		$(this).parent().parent().find(".total_count").text(total_price);
		refresh_order();
		return false;
	});
	
	
	
	function refresh_order(){
		summ = 0;
		$('table#products_old tbody tr').each(function(){
				summ += parseInt( $(this).find(".total_count").text() );
		});
		
		$('table#products tbody tr').each(function(){
			summ += parseInt( $(this).find(".total_count").text() );
		});
		$('#itog_day').show().find('span').text( summ );
		
		if ( $('#arenda_days').find('span').text()){
			all = summ * parseInt( $('#arenda_days').find('span').text() );
			$('#itog_all').show().find('span').text( all );
			if ( !$('#orders-user_price').prop("checked") ){
				$('#orders-summ').val( all );
			}
		}
		
		return false;
	}
	
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


