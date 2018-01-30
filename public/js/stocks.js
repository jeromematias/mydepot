var stocksArray = [];
$(document).ready(function(){
	var stockmodalshown = false
	$('#StocksModal').on('shown.bs.modal', function() {
		appendStocks();
		/*if(stockmodalshown==false){
          appendStocks();
          stockmodalshown=true         
		}*/
    })
    $('#PrintStock').click(function(){        
		$('#StockList').print({
		  //Use Global styles
		  globalStyles : true,
		  //Add link with attrbute media=print
		  mediaPrint : true,
		  //Custom stylesheet
		  stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
		  //Print in a hidden iframe
		  iframe : true,
		  //Don't print this
		  noPrintSelector : ".avoid-this",
		  //Add this at top
		  prepend : "",
		  //Add this on bottom
		  append : "<br/>Buh Bye!",
		  //Log to console when printing is done via a deffered callback
		  deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
		});
	})
	$('#PrintSales').click(function(){        
		$('#tb-salesinventory').print({
		  //Use Global styles
		  globalStyles : true,
		  //Add link with attrbute media=print
		  mediaPrint : true,
		  //Custom stylesheet
		  stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
		  //Print in a hidden iframe
		  iframe : true,
		  //Don't print this
		  noPrintSelector : ".avoid-this",
		  //Add this at top
		  prepend : "",
		  //Add this on bottom
		  append : "<br/>Buh Bye!",
		  //Log to console when printing is done via a deffered callback
		  deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
		});
	})
    $('#stockdate').fadeOut()
    $('#deliverystatus').on('change',function(){
    	var status = $(this).val();
    	if(status == 0){
    		$('#SaveStock,#RemoveStock').fadeOut('fast')
    	}else if(status == 1){
    		$('#RemoveStock').fadeOut('fast')
    		$('#SaveStock').fadeIn('fast')    		
    	}else if(status == 2 || status == 3){
    		$('#SaveStock').fadeOut('fast')
    		$('#RemoveStock').fadeIn('fast')    		  
    	}
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	  var target = $(e.target).attr("href") // activated tab
	  if(target == '#SPanel'){
	  	appendStocks();
	  	$('#stockdate').fadeOut()
	  	$('#stockbtns').fadeIn()
	  }else if(target == '#SStocks'){
	  	stockinout()
	  	$('#stockbtns').fadeOut()
	  	$('#stockdate').fadeOut()
	  }else if(target == '#SInventory'){
	  	SalesInventory($('#filterdate').val());
	  	$('#stockbtns').fadeOut()
	  	$('#stockdate').fadeIn()
	  }else if(target == '#PLog'){
	  	GetPurchaseLogs();
	  	$('#stockbtns').fadeOut()
	  	$('#stockdate').fadeOut()
	  }
	});
	$('#ShowStocksModal').click(function(e){
		e.preventDefault();
		$('#StocksModal').modal("show")		
	})	
	$('#SaveStock, #RemoveStock').click(function(){
		var btn = $(this);		
		var action = $(this).data("id") == 'add' ? 'increment' : 'decrement';
		if($('#stockQty').val() != "" && $('#stockQty').val() > 0){
			$('input[name=item_id]:checked').each(function(){
				var item_id = $(this).val();
				stocksArray.push({
					ingID : item_id,
					ingqty : $('#stockQty').val()
				})
				$(this).prop('checked',false)	
														
			})
			$		
			if(stocksArray.length != 0){
				btn.prop('disabled',true)
				updateStocks(stocksArray,action,btn,$('#deliverystatus').val())
			}else{
				var box = bootbox.alert("Please select ingredients")
				centralizemodal(box)
			}				
		}else{
			var box = bootbox.alert("Please input quantity")
			centralizemodal(box)
		}		
	})
	$('#GenSales').click(function(){
		var setdate = $('#filterdate').val()
		SalesInventory(setdate)
	})
	function SalesInventory(setdate){		
		$.ajax({
			url : window.location.href + '/SalesInventory',
			type : 'GET',
			data : {salesdate : setdate},
			success : function(data){
				var totalsales = 0;
				var output = '<table class="table table-hover" id="tb-salesinventory" cellpadding="0" cellspacing="0">'
					output += '<thead class="bg-gold">'
					output += '<tr>'
					output += '<th>Name</th>'
					output += '<th class="text-center">Total Sold</th>'
					output += '<th class="text-center">Sales</th>'
					output += '<th class="text-center">Price</th>'
					output += '</tr>'
					output += '</thead>'
					output += '<tbody class="table-sm">'
				for(var i in data){
					output += '<tr>'
					output += '<td>'+data[i].name+'</td>'
					output += '<td class="text-center">'+data[i].quantity+'</td>'
					output += '<td class="text-center"> PHP '+data[i].totalsales+'</td>'
					output += '<td class="text-center"> PHP '+data[i].price+'</td>'
					output += '</tr>'
					totalsales += data[i].totalsales
				}
					output += '<tr>'
					output += '<th class="text-center" colspan="2"> Total Sales </th>'				
					output += '<th class="text-center bg-info"> PHP '+totalsales+'</th>'
					output += '<th class="text-center">-</th>'
					output += '</tr>'
					output += '</tbody>'
					output += '</table>'
				$('#salesinventory').html(output)
				
			}
		})
	}
	function stockinout(){
		$.ajax({
			url : window.location.href + '/Stockinout',
			type : 'GET',			
			success : function(data){
				var output = '<table class="table table-hover" id="tb-stockinout" cellpadding="0" cellspacing="0">'
					output += '<thead class="bg-gold">'
					output += '<tr>'
					output += '<th>Ingredient</th>'
					output += '<th>Quantity</th>'
					output += '<th>Actual Stock</th>'
					output += '<th>Date Delivery</th>'
					output += '<th>Delivery Type</th>'
					output += '</tr>'
					output += '</thead>'
					output += '<tbody class="table-sm">'
				for(var i in data){
					output += '<tr>'
					output += '<td>'+data[i].item_name+'</td>'
					if(data[i].stocktype == 'pecies'){
						output += '<td class="text-right">'+data[i].quantity + ' pcs</td>'
						output += '<td class="text-right">'+data[i].currentstock+'</td>'
					}else{
						if(data[i].quantity >= 1000){
							var qnum = Number(data[i].quantity / 1000)
							output += '<td class="text-right">'+qnum + ' kg</td>'
						}else{
							var qnum = Number(data[i].quantity)
							output += '<td class="text-right">'+qnum + ' g</td>'
						}
						if(data[i].currentstock>=1000){
							output += '<td class="text-right">'+ Number(data[i].currentstock / 1000) +' kg</td>'
						}else{
							output += '<td class="text-right">'+data[i].currentstock+' g</td>'
						}
					}										
					output += '<td>'+data[i].datedelivery+'</td>'
					output += '<td>'+data[i].type+'</td>'
					output += '</tr>'
				}
					output += '</tbody>'
					output += '</table>'
				$('#stockinout').html(output)
				$('#tb-stockinout').DataTable({
                    dom: 'ft',
                    scrollY: 400,
                    scrollCollapse: true,
                    responsive: true,
                    paging : false,
                    ordering : false,
                });
			}
		})
	}
	function updateStocks(stocks,action,btn,deliverystatus){				
		$.ajax({
			url : window.location.href + '/updateStocks',
			type : 'POST',
			data : {
				stocksArray : stocks,
				action : action,
				deliverystatus : deliverystatus,
			},
			success : function(data){						
				if(data.msg == 'success'){
					$('#stockQty').val('')
					appendStocks()					
					stocksArray = [];
					btn.prop('disabled',false)
					$('input[name=select_all]').prop('checked',false)
					$('#deliverystatus').val(0).trigger('change')
				}
			},
			error : function(err){
				stocksArray = [];
				var box = bootbox.alert("Sorry please check quantity and available stocks. Thanks!")
				centralizemodal(box)
				btn.prop('disabled',false)
				$('input[name=select_all]').prop('checked',false)
			}
		})
	}
	function appendStocks(){
		$.ajax({
			url : window.location.href + '/stocklist',
			type : 'GET',
			success : function(data){
				$('#stockpanel').html(data)
				$('#StockList').DataTable({
                    dom: 't',
                    scrollY: 400,
                    scrollCollapse: true,
                    responsive: true,
                    paging : false,
                    ordering : false,
                });
                $('input[name=select_all]').click(function(){
                	var status = $(this).prop('checked')                	
                	$('input[name=item_id]').each(function(){						
						$(this).prop('checked',status)																
					})
                })
				$('#StockList tbody tr').click(function(){				
					var checkbox = $(this).find('td:eq(2) input[name=item_id]')
					if(checkbox.prop('checked') == false){
						checkbox.prop('checked',true)
					}else{
						checkbox.prop('checked',false)
					}
				})
			}
		})
	}
	function GetPurchaseLogs(){
		$.ajax({
			url : window.location.href + '/GetPurchaseLogs',
			type : 'GET',
			success : function(data){
				var output = '<table class="table table-hover" id="tb-purchaselog" cellpadding="0" cellspacing="0">'
					output += '<thead class="bg-gold">'
					output += '<tr>'
					output += '<th>Name</th>'
					output += '<th>Date Purchased</th>'
					output += '<th>Quantity</th>'
					output += '</tr>'
					output += '</thead>'
					output += '<tbody class="table-sm">'
				for(var i in data){					
					output += '<tr>'
					output += '<td>'+ data[i].name +'</td>'
					output += '<td>'+ data[i].purchasedate +'</td>'
					output += '<td>'+ data[i].quantity +'</td>'
					output += '</tr>'
				}
					output += '</tbody>'
					output += '</table>'
				$('#purchaselog').html(output)
				$('#tb-purchaselog').DataTable({
					dom : 't',
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
				$('#salesinventory').html(data)
				$('#tableIngredientsInventory').DataTable({
					dom : 't',
					scrollY: 400,
                    scrollCollapse: true,                    			
				})
			}
		})		
	}
	function centralizemodal(box){
		var dialog = box.find('.modal-dialog');
	    box.css('display', 'block');    
	    dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2)); 
	}
})