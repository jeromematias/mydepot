$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};

$(document).ready(function(){
    var listtype = 'list';
    var categorytype = '';
    $('#PaymentCash').numpad();
    $('#CancelPending').click(function(e){
    	e.preventDefault()
    	$('#PaymentCash').val('')
    	pendingArray = [];
        CustomerChange = 0;               
        $('#Total-Change').text("Change : " + CustomerChange)
    	var table = $('#tablepending').DataTable();
        table.clear().draw();
        TotalPrice(pendingArray) 
    })
    $('#PaymentCash').on('change',function(){
        enablePaymentBtn()
    })
    var CustomerChange = 0;
    function enablePaymentBtn(){
        var cash = $('#PaymentCash').val();        
        if(cash >= totalPrice){            
            if(pendingArray.length == 0){
                $('#PaymentCash').val('')
                var box = bootbox.alert('Please select item to be purchase first. Thanks!')
                centralizemodal(box)
            }else{
                $('#BtnPurchase').prop('disabled',false)
                CustomerChange = cash - totalPrice;                
                $('#Total-Change').text("Change : " + CustomerChange)                
            }
        }else{
            var box = bootbox.alert("Sorry! Customer's Cash is not enough. Please try again!")
            centralizemodal(box)
            cash = 0;
            $('#PaymentCash').val(cash)
        }  
    }
    $('#BtnPurchase').click(function(){
        PurchaseItems()
    })
    function PurchaseItems(){
        $.ajax({
            url : window.location.href + '/PurchaseItems',
            type : 'GET',
            data : {
                pendingArray : pendingArray,
                Cash : $('#PaymentCash').val(),
                Change : CustomerChange,
                Price : totalPrice
            },
            success : function(data){
                console.log(data.menu)
                if(data.msg == 'success'){
                    var box = bootbox.alert('<h5><i class="fa fa-money" aria-hidden="true"></i> Customer Change is Php '+Number(CustomerChange).toFixed(2)+'</h5>')
                    centralizemodal(box)
                    CustomerChange = 0;
                    pendingArray = [];                                   
                    $('#Total-Change').text("Change : " + CustomerChange)
                    ResetVar()
                    TotalPrice(pendingArray)
                    var table = $('#tablepending').DataTable();
                    table.clear().draw();                    
                }
            }
        })    
    }
    GetCategory();
    getPending();

    function getPending() {
        $.ajax({
            url: window.location.href + '/pendinglist',
            type: 'GET',            
            success: function(data) {
                $('#pendinglist').html(data)
                $('#tablepending').DataTable({
                    dom: 'ft',
                    scrollY: $('#pendingpanel .modal-body').height() - 100,
                    scrollCollapse: true,
                    responsive: true,
                    ordering : false
                })
            }
        })
    }

    function GetSalesMenu(categorytype, listtype) {
        $.ajax({
            url: window.location.href + '/SalesMenu',
            type: 'GET',            
            data: {
                cat_id: categorytype,
                list: listtype
            },
            success: function(data) {
               $('#productlist').html(data)
                purchase()
                $('#menuList').DataTable({
                    dom: 't',
                    scrollY: $('#productpanel .modal-body').height() - 100,
                    scrollCollapse: true,
                    responsive: true,
                    paging : false,
                })
            }
        })
    }

    function purchase() {
        $('#menuList #btn-purchase, #tilepanel #btn-purchase').each(function() {
            $(this).click(function() {
                var menu = $(this).data("value"),
                    id = $(this).data("id");
                for (var i in menu) {
                    if (menu[i].menu_id == id) {
                        var name = menu[i].name,
                            price = menu[i].price;
                    }
                }
                GetMenuIngredients(id, name, price);
            })
        })
    }

    function GetMenuIngredients(id, name, price) {
        $.ajax({
            url: window.location.href + '/GetMenuIngredients',
            type: 'GET',            
            data: {
                id: id
            },
            success: function(data) {
                var menuarray = []
                for (var i in data.MenuIngredients) {
                    menuarray.push({
                        item_id: data.MenuIngredients[i].item_id,
                        quantity: data.MenuIngredients[i].quantity
                    })
                }
                checkavailableStocks(menuarray, id, name, price)
            }
        })
    }    
    function checkavailableStocks(menu, menu_id, name, price) {
        $.ajax({
            url: window.location.href + '/checkStocks',
            type: 'GET',            
            data: {
                menu: menu
            },
            success: function(data) {
                var items = [];
                var status = true;                
                for (var i in data.data) {
                	var tdQty = (Number(menu[i].quantity) * (Number($('#tablepending #row' + menu_id).find('td:eq(2)').text()) + Number(1)) );
                    if (data.data[i][0].qty < tdQty) {
                        status = false;
                        break;
                    }
                    items.push({
                        id: data.data[i][0].id,
                        name: data.data[i][0].name,
                        qty: data.data[i][0].qty
                    })
                }
                console.log(menu_id)
                if (status == false) {
                    var box = bootbox.alert("Sorry! <code>Out of stock</code>")
                    centralizemodal(box)
                } else {                	
                    addpendingitem(menu_id, name, price, 'add')
                }
            }
        })
    }
    var pendingArray = [];

    function addpendingitem(menu_id, name, price, action) {
        var row = '';
        var t = $('#tablepending').DataTable();
        var checkExisting = false;
        for (var x in pendingArray) {
            if (pendingArray[x].id == menu_id) {
            	var arrayindex = Number(x)
            	if(action == 'add'){
            		pendingArray[x].quantity = pendingArray[x].quantity + 1;
            	}else{
            		pendingArray[x].quantity = pendingArray[x].quantity - 1;                    
            	}                
                checkExisting = true;
                break;
            }            
        }
        var rowid = "row" + menu_id;
        if(action == 'add')
	        if (checkExisting == false) {
	            pendingArray.push({
	                id: menu_id,
	                price: price,
	                quantity: 1
	            });
	            var rowNode = t.row.add([
	                name,
	                price,
	                1,
	                '<button class="btn btn-sm btn-danger ' + menu_id + '" data-id="' + menu_id + '" id="deductqty"><i class="fa fa-times" aria-hidden="true"></i></button>'
	            ]).draw(true).node();
	            $(rowNode).attr('id', rowid);
	            $('#tablepending .' + menu_id).click(function(e) {
	                e.preventDefault()
	                var updateID = $(this).data('id')
	                addpendingitem(updateID, '', '', 'remove')
	            })
	        } else {
	            var tdQty = $('#tablepending #' + rowid).find('td:eq(2)').text();
	            $('#tablepending #' + rowid).find('td:eq(2)').text(Number(tdQty) + Number(1))
	        }
	    else{
	    	var tdQty = $('#tablepending #' + rowid).find('td:eq(2)').text();
	    	if(tdQty > 1){
	    		$('#tablepending #' + rowid).find('td:eq(2)').text(Number(tdQty) - Number(1))
	    	}else{	    		
	    		pendingArray.splice(arrayindex, 1);                                   			    	
        		t.row('#' + rowid).remove().draw(false);    		
	    	}	        
	    }
        ResetVar()             
        TotalPrice(pendingArray)
    }
    function ResetVar(){
        $('#PaymentCash').val('')
            CustomerChange = 0;               
            $('#Total-Change').text("Change : " + CustomerChange)
            $('#BtnPurchase').prop('disabled',true)   
    }
    var totalPrice = 0;
    function TotalPrice(pending){   
    	var PendingTotalPrice = 0; 	
    	for(var i in pendingArray){
    		PendingTotalPrice = PendingTotalPrice + (pending[i].price * pending[i].quantity)
    	}
    	totalPrice = PendingTotalPrice;
    	$('#Total-Price').text("Total Price : " + totalPrice.toFixed(2))
    }
    function GetCategory() {
        $.ajax({
            url: window.location.href + '/getCategory',            
            success: function(data) {
                //console.log(data)                             
                for (var i in data.category) {
                    $('#Category').append('<button class="btn bg-default" data-id="' + data.category[i].cat_id + '" id="showbycategory">' + data.category[i].category_name + '</button')
                }
                $('#Category #showbycategory').each(function() {
                    $(this).click(function(e) {
                        e.preventDefault();
                        $('#Category #showbycategory').each(function() {
                            $(this).removeClass("btn-primary")
                        })
                        $(this).addClass("btn-primary")
                        categorytype = $(this).data('id')
                        GetSalesMenu(categorytype, listtype)
                    })
                })
                GetSalesMenu(categorytype, listtype);
            }
        })
    }
    $('#productpanel #listtype').each(function() {
        $(this).click(function() {
            $('#productpanel #listtype').each(function() {
                $(this).removeClass("btn-primary")
            })
            $(this).addClass("btn-primary")
            listtype = $(this).data('id')
            GetSalesMenu(categorytype, listtype);
        })
    })
    function centralizemodal(box){
        var dialog = box.find('.modal-dialog');
        box.css('display', 'block');    
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2)); 
    }
})
document.onreadystatechange = function(e) {
    if (document.readyState == "interactive") {
        var all = document.getElementsByTagName("*");
        for (var i = 0, max = all.length; i < max; i++) {
            set_ele(all[i]);
        }
    }
}

function check_element(ele) {
    var all = document.getElementsByTagName("*");
    var totalele = all.length;
    var per_inc = 100 / all.length;

    if ($(ele).on()) {
        var prog_width = per_inc + Number(document.getElementById("progress_width").value);
        document.getElementById("progress_width").value = prog_width;
        $("#bar1").animate({
            width: prog_width + "%"
        }, 10, function() {
            if (document.getElementById("bar1").style.width == "100%") {
                $(".progress").fadeOut("fast");
            }
        });
    } else {
        set_ele(ele);
    }
}

function set_ele(set_element) {
    check_element(set_element);
}