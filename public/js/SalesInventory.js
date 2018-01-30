$(document).ready(function(){	
	GetSales()	
	$('a[href="#inventory"]').on('shown.bs.tab', function (e) {
          //$('#ClearTransaction').text('Clear Transaction') RecieptInfo
          GetIngredientsInventory()
    });	
	function GetSales(){
		$.ajax({
			url : window.location.href + '/GetSales',
			type : 'GET',
			data : {
				//Date : 'asdsa'
			},
			success : function(data){
				$('#panel').html(data)
				$('#tableSales').DataTable({
					dom : 'ft',
					scrollY: 400,
                    scrollCollapse: true,                    			
				})
			}
		})
	}	
	function GetIngredientsInventory(){
		$.ajax({
			url : window.location.href + '/GetIngredientsInventory',
			type : 'GET',
			success : function(data){
				$('#panel2').html(data)
				$('#tableIngredientsInventory').DataTable({
					dom : 'ft',
					scrollY: 400,
                    scrollCollapse: true,                    			
				})
			}
		})		
	}
})