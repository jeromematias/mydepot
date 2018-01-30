<div class="row">
    <div class="col-sm-12">
        <label for="Category">Category</label>
        <select id="Category" name="Category" class="form-control form-control-sm col-md-7" name="Category"></select>
        <button class="btn btn-sm btn-secondary btn-ing" id="UpdateCategory">Update Category</button>
        <button class="btn btn-sm btn-secondary btn-ing" id="AddnewCategory">Add new Category</button>        
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="name">Name</label>
        <input type="text" id="menu_name" class="form-control form-control-sm col-md-12" name="menu_name">
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="MenuPrice">Price</label>
        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="MenuPrice" class="form-control form-control-sm col-md-6" name="MenuPrice" placeholder="">
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="drink">Drinks</label>
        <select id="drink" name="Drinks" class="form-control form-control-sm col-md-8" name="drink"></select>
        <button class="btn btn-sm btn-secondary btn-ing" id="UpdateDrinks">Update Drinks</button>
        <button class="btn btn-sm btn-secondary btn-ing" id="AddNewDrinks">Add new Drinks</button>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="Ingredients">Ingredients</label>
        <select id="Ingredients" name="Ingredients" class="form-control form-control-sm col-md-8"></select>
        <label for="NumberofIngredients">Quantity</label>
        <input type="text" id="NumberofIngredients" class="form-control form-control-sm col-md-2 input-sm" name="NumberofIngredients">
        <button class="btn btn-sm btn-secondary btn-ing" id="AddNewIng">Add new ingredient</button>
        <button class="btn btn-sm btn-secondary btn-ing" id="UpdateIng">Update ingredient</button>
        <button class="btn btn-sm btn-primary btn-ing" id="AddIng">Add ingredient</button>
        <table class="table table-bordered table-hover" id="ingredientList" width="100%" data-order="[[ 1 , &quot;asc&quot; ]]">
            <thead>
                <tr>
                    <th>Ingredient name</th>
                    <th>Quantity</th>
                    <th data-orderable="false">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>