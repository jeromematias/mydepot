$(document).ready(function() {
    var ingredientsList = [];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var initialize_option = GetCategory();
    initialize_option.then(GetDrinks())
        .then(GetIngredients());

    $('#SubmitBurger').click(function(e) {
        e.preventDefault();
    })
    //NEW MENU
    init_btn_update();
    ShowMenuIngredients();    
    
    $('#Ingredients-qty, #stockQty, #NumberofIngredients').keypress(function(eve) {
        if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
        eve.preventDefault();
        }
        // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
        $('#Ingredients-qty, #stockQty, #NumberofIngredients').keyup(function(eve) {
            if($(this).val().indexOf('.') == 0) {
                $(this).val($(this).val().substring(1));
            }
        });
    });

    $('#AddIng').click(function(){
        if($('#NumberofIngredients').val() != "" && $('#Ingredients').val() != ""){
            $('div#mainpanel').animate({scrollTop:$('#mainpanel').height()}, 500, 'swing');
        }          
    })
    $('#ScrollUp').click(function(){
        //$('div#mainpanel').animate({scrollTop:$('#mainpanel').height()}, 1000, 'swing');
        $('div#mainpanel').animate({scrollTop:0}, 500, 'swing');   
          
    })
    var MenuAction = 'NewMenu';
    $('#CancelNemu').click(function(){
        MenuAction = 'NewMenu';
        ingredientsList = [];
        $('div#mainpanel').animate({scrollTop:0}, 500, 'swing');                        
        $('#Category').val('')
        $('#menu_name').val('')
        $('#MenuPrice').val('')
        $('#drink').val(0)
        ingredientsList = []
        var table = $('#ingredientList').DataTable();
        table.clear().draw(); 
    })
    function init_btn_update() {
        $('#menuList #updateMenu').each(function() {
            $(this).click(function() {                
                $('#Category').val($(this).closest('tr').find('td:eq(1)').attr("id"))
                $('#menu_name').val($(this).closest('tr').find('td:eq(2)').attr("id"))
                $('#MenuPrice').val($(this).closest('tr').find('td:eq(3)').attr("id"))
                $('#drink').val($(this).closest('tr').find('td:eq(4)').attr("id"))
                GetMenuIngredients($(this).closest('tr').find('td:eq(0)').attr("id"));
                MenuAction = "UpdateMenu";
            })
        })
    }
    function ShowMenuIngredients(){
        $('#menuList #ShowIngredients').each(function(){
            $(this).click(function(){ bootbox.alert("test") })
        })
    }
    var updateID = '';
    function GetMenuIngredients(id){
        updateID = id;
        $.ajax({
            url : window.location.href + '/GetMenuIngredients',
            type : 'GET',
            data : {
                id : id
            },
            success : function(data){
                var t = $('#ingredientList').DataTable();                    
                    t.clear().draw();      
                ingredientsList = [];          
                for(var i in data.MenuIngredients){                    
                    ingredientsList.push({
                        'id': data.MenuIngredients[i].item_id,
                        'ingredientName': data.MenuIngredients[i].item_name,
                        'quantity': data.MenuIngredients[i].quantity
                    });                                    
                    var rowNode = t.row.add([
                        data.MenuIngredients[i].item_name,
                        data.MenuIngredients[i].quantity,
                        '<button data-id="' + data.MenuIngredients[i].item_id + '" class="btn btn-sm btn-danger cancel_ing"><i class="fa fa-minus-square"></i> Cancel</button>'
                    ]).draw(false).node();
                    $(rowNode).attr('id', data.MenuIngredients[i].item_id);

                }                
                    $('#ingredientList .cancel_ing').each(function() {
                        $(this).click(function(e) {
                            e.preventDefault();
                            deleteRow($(this).data('id'));
                        })
                    })
                console.clear()
                console.log(ingredientsList)                
            }
        })
    }
    $('#SubmitMenu').click(function(e) {
        e.preventDefault();
        var RequestType = MenuAction == 'NewMenu' ? "POST" : "GET";
            //alert(RequestType + "/" + MenuAction)
        if ($('#Category').val() != "" && $('#menu_name').val() != "" && $('#MenuPrice').val() != "" && $('#drink').val() != "" && ingredientsList != []) {                
            $.ajax({
                url: window.location.href + "/"+MenuAction,
                type: RequestType,
                data: {
                    menu_id : updateID,
                    cat_id: $('#Category').val(),
                    menu_name: $('#menu_name').val(),
                    MenuPrice: $('#MenuPrice').val(),
                    drink: $('#drink').val(),
                    ingredients: ingredientsList
                },
                success: function(data) {
                     $('div#mainpanel').animate({scrollTop:0}, 500, 'swing');                        
                        $('#Category').val('')
                        $('#menu_name').val('')
                        $('#MenuPrice').val('')
                        $('#drink').val(0)
                        ingredientsList = []
                        var table = $('#ingredientList').DataTable();
                        table.clear().draw();
                        console.log(data)
                        GetMenu();
                }
            })
        } else {
            bootbox.alert("Please complete all information needed!")
        }
    })

    function GetMenu() {
        $.ajax({
            url: window.location.href + '/GetMenu',
            type: 'GET',
            success: function(data) {
                var output = data;
                $('#MenuSection').html(output)
                init_btn_update();
            }
        })
    }
    $('#ingredientList').DataTable({
        dom: 't',
        responsive: true,
        scrollY: '200px'
    });
    var ingr_action = "";
    cat_action = '',
        drink_action = '';

    $('#AddNewIng, #UpdateIng').click(function(e) {
        e.preventDefault();
        ingr_action = $(this).attr("id");

        var validate_action = (ingr_action == 'UpdateIng' && $('#Ingredients').val() != "") || (ingr_action == 'AddNewIng') ? true : false;
        if (validate_action == true) {
            $('#ingredientModal').modal("show")
        } else {
            bootbox.alert("Please select Ingredients name that needs to be change!")
        }
    })
    //add new ingred.
    $('#saveIngredients').click(function(e) {
        e.preventDefault();
        var ingname = $('#Ingredients-name').val(),
            ingqty = $('#Ingredients-qty').val(),
            type = $('#stocktype').val();
        saveIngredients(ingname, ingqty, ingr_action, $('#Ingredients').val(), $(this),type);
    })
    //Add new Ingredients   
    function saveIngredients(ingname, ingqty, action, ingID, btnname,type) {
        if (ingname != "" && ingqty != "") {
            btnname.prop('disabled', true);
            if (action == 'AddNewIng') {
                var url = window.location.href + '/Addingredients';
                var data = {
                    'ingname': ingname,
                    'ingqty': ingqty,
                    'type' : type,
                }
            } else {
                var url = window.location.href + '/UpdateIngredients';
                var data = {
                    'ingID': ingID,
                    'ingname': ingname,
                    'ingqty': ingqty,
                    'type' : type,
                }
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(data) {
                    if (data.msg == 'success') {
                        $('#Ingredients-name').val("")
                        $('#Ingredients-qty').val("")
                        GetIngredients();
                        var btn = $(btnname);
                        btn.prop('disabled', false);
                        if (action != 'AddNewIng') {
                            $('#ingredientModal').modal("hide")
                        }
                    }
                }
            })
        } else {
            bootbox.alert("Please Ingredient name and quantity!")
        }
    }
    //add || update category
    $('#AddnewCategory, #UpdateCategory').click(function(e) {
        e.preventDefault();
        cat_action = $(this).attr("id");

        var validate_category = (cat_action == 'UpdateCategory' && $('#Category').val() != "") || (cat_action == 'AddnewCategory') ? true : false;

        if (validate_category == true) {
            $('#CategoryModal').modal("show")
        } else {
            bootbox.alert("Please select Category name that needs to be change!")
        }
    })
    $('#SaveCategory').click(function(e) {
        e.preventDefault();
        var btn_da = $('#SaveCategory');
        var categoryname = $('#Categoryname').val();
        if (categoryname != "") {
            btn_da.prop('disabled', true);
            if (cat_action == "AddnewCategory") {
                $.ajax({
                    url: window.location.href + '/SaveCategory',
                    type: 'POST',
                    data: {
                        category: categoryname,
                    },
                    success: function(data) {
                        GetCategory();
                        bootbox.alert("New Category added {categoryname : " + categoryname + "}!");
                        btn_da.prop('disabled', false);
                    }
                })
            } else {
                var id = $('#Category').val();
                $.ajax({
                    url: window.location.href + '/updateCategory',
                    type: 'POST',
                    data: {
                        id: id,
                        category: categoryname,
                    },
                    success: function(data) {
                        GetCategory();
                        bootbox.alert("Category update successful {categoryname : " + categoryname + "}!");
                        btn_da.prop('disabled', false);
                        $('#CategoryModal').modal("hide")
                    }
                })
            }
            $('#Categoryname').val('');
        } else {
            bootbox.alert("Please input category name first!")
        }
    })
    $('#price, #NumberofIngredients').on('input', function(e) {
        $(this).val($(this).val().replace(/^0+/, ''));
    })
    //add ingred.
    $('#AddIng').click(function(e) {
        e.preventDefault();
        var id = $('#Ingredients option:selected').val(),
            ingredientName = $('#Ingredients option:selected').text(),
            ingredientQty = $('#NumberofIngredients').val();
        AddIng(id, ingredientName, ingredientQty)
    })
    //add drink
    $('#UpdateDrinks, #AddNewDrinks').click(function(e) {
        e.preventDefault();
        drink_action = $(this).attr("id");
        var validate_drink = (drink_action == 'UpdateDrinks' && $('#drink').val() != 1) || (drink_action == 'AddNewDrinks') ? true : false;
        if (validate_drink == true) {
            $('#DrinksModal').modal("show")
        } else {
            bootbox.alert("Please select beverage/drink name that needs to be change!")
        }
    })
    $('#SaveDrinks').click(function(e) {
        e.preventDefault();
        var drinks = $('#Drinks-name').val();
        var btn_da = $('#SaveDrinks');
        SaveDrinks(drinks, btn_da);
    })
    //Drinks
    function SaveDrinks(drinks, btn_da) {
        if (drinks != "") {
            btn_da.prop('disabled', true)
            if (drink_action == "AddNewDrinks") {
                $.ajax({
                    url: window.location.href + '/SaveDrinks',
                    type: 'POST',
                    data: {
                        drinks: drinks
                    },
                    success: function(data) {
                        GetDrinks();
                        $('#Drinks-name').val('');
                        bootbox.alert("New Drink Added!")
                        btn_da.prop('disabled', false)
                    }
                })
            } else {
                var id = $('#drink').val()
                $.ajax({
                    url: window.location.href + '/UpdateDrinks',
                    type: 'POST',
                    data: {
                        id: id,
                        drinks: drinks
                    },
                    success: function(data) {
                        GetDrinks();
                        $('#Drinks-name').val('');
                        bootbox.alert("Beverage update successful!");
                        btn_da.prop('disabled', false);
                        $('#DrinksModal').modal("hide");
                    }
                })
            }
        } else {
            bootbox.alert('Please input drinks name')
        }
    }

    function GetCategory() {
        var promise = new Promise(function(resolve, reject) {
            $.ajax({
                url: window.location.href + '/getCategory',
                success: function(data) {
                    //console.log(data)             
                    $('#Category').find('option').remove();
                    var selectBox = document.getElementById('Category');
                    if (data.category != "") {
                        selectBox.options.add(new Option('Select Category here . .', ''));
                        for (var i in data.category) {
                            selectBox.options.add(new Option(data.category[i].category_name, data.category[i].cat_id));
                        }
                    } else {
                        selectBox.options.add(new Option('No Category added yet, Please click add new Category at the bottom!', ''));
                    }
                }
            })
        })
        return promise;
    }

    function GetDrinks() {
        var GetDrinks = new Promise(function(resolve, reject) {
            $.ajax({
                url: window.location.href + '/drinks',
                success: function(data) {
                    //console.log(data)             
                    $('#drink').find('option').remove();
                    var selectBox = document.getElementById('drink');
                    if (data.drinks != "") {                       
                        for (var i in data.drinks) {
                            selectBox.options.add(new Option(data.drinks[i].drinksname, data.drinks[i].id));
                        }
                    } else {
                        selectBox.options.add(new Option('No Drinks added yet, Please click add new Drinks at the bottom!', ''));
                    }
                }
            })
        })
        return GetDrinks;
    }

    function GetIngredients() {
        var GetIngredients = new Promise(function(resolve, reject) {
            $.ajax({
                url: window.location.href + '/GetIngredients',
                success: function(data) {
                    //console.log(data)             
                    $('#Ingredients').find('option').remove();
                    var selectBox = document.getElementById('Ingredients');
                    if (data.ingredients != "") {
                        selectBox.options.add(new Option('Select Ingredients here . .', ''));
                        for (var i in data.ingredients) {
                            selectBox.options.add(new Option(data.ingredients[i].item_name, data.ingredients[i].id));
                        }
                    } else {
                        selectBox.options.add(new Option('No Ingredient added yet, Please click add new Ingredient at the bottom!', ''));
                    }
                }
            })
        })
        return GetIngredients;
    }
    //add ingredients
    function checkAvailableStocks(id, ingredientName, ingredientQty) {
        $.ajax({
            url: window.location.href + '/checkAvailableStocks',
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data.quantity)
                var availableQty = data.quantity[0].qty;
                if (Number(availableQty) >= Number(ingredientQty)) {
                    ingredientsList.push({
                        'id': id,
                        'ingredientName': ingredientName,
                        'quantity': ingredientQty
                    });
                    //console.log(ingredientsList)                
                    var t = $('#ingredientList').DataTable();
                    var rowNode = t.row.add([
                        ingredientName,
                        ingredientQty,
                        '<button data-id="' + id + '" class="btn btn-sm btn-danger cancel_ing"><i class="fa fa-minus-square"></i> Cancel</button>'
                    ]).draw(false).node();
                    $(rowNode).attr('id', id);
                    $('#ingredientList .cancel_ing').each(function() {
                        $(this).click(function(e) {
                            e.preventDefault();
                            deleteRow($(this).data('id'));
                        })
                    })
                } else {
                    bootbox.alert("Sorry! " + ingredientName + " has " + Number(availableQty) + " available stocks left, please add more stocks for this ingredient!!")
                }
            },
            error : function(e){
                bootbox.alert("Something went wrong with the system Please do add an Ingredient Again. Thanks!")
            }
        })
    }

    function AddIng(id, ingredientName, ingredientQty) {
        if (id != "" && ingredientQty != "" && ingredientQty >= 0) {
            var checkExisting = false;
            for (var i in ingredientsList) {
                if (ingredientsList[i].id == id) {
                    checkExisting = true;
                    break;
                }
            }
            var output = "";
            if (checkExisting == false) {
                checkAvailableStocks(id, ingredientName, ingredientQty);

            } else {
                bootbox.alert("Ingredient added already!");
            }
            $('#Ingredients').val('');
            $('#NumberofIngredients').val('');
        } else {
            bootbox.alert('Please select Ingredient and input quantity greater than 0')
        }
    }

    function deleteRow(btn_id) {
        for (var i in ingredientsList) {
            if (ingredientsList[i].id == btn_id) {
                ingredientsList.splice(i, 1);
            }
        }
        var table = $('#ingredientList').DataTable();
        table.row('#' + btn_id).remove().draw(false);
    }
})
document.onreadystatechange = function(e)
{
  if(document.readyState=="interactive")
  {
    var all = document.getElementsByTagName("*");
    for (var i=0, max=all.length; i < max; i++) 
    {
      set_ele(all[i]);
    }
  }
}

function check_element(ele)
{
  var all = document.getElementsByTagName("*");
  var totalele=all.length;
  var per_inc=100/all.length;

  if($(ele).on())
  {
    var prog_width=per_inc+Number(document.getElementById("progress_width").value);
    document.getElementById("progress_width").value=prog_width;
    $("#bar1").animate({width:prog_width+"%"},10,function(){
      if(document.getElementById("bar1").style.width=="100%")
      {
        $(".progress").fadeOut("fast");
      }         
    });
  }

  else  
  {
    set_ele(ele);
  }
}

function set_ele(set_element)
{
  check_element(set_element);
}