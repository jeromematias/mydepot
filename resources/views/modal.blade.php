<!-- Category modal -->    
<div class="modal fade" id="CategoryModal" role="dialog" aria-labelledby="CategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CategoryModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!!csrf_field()!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="Category">Category</label>
                            <input type="text" id="Categoryname" class="form-control form-control-sm col-md-12" name="Category">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveCategory">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- drinks modal -->    
<div class="modal fade" id="DrinksModal" role="dialog" aria-labelledby="DrinksModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DrinksModalLabel">New Drinks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!!csrf_field()!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="Drinks-name">Drinks Name</label>
                            <input type="text" id="Drinks-name" class="form-control form-control-sm col-md-12" name="Drinks-name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveDrinks">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Ingredients Modal -->
<div class="modal fade" id="ingredientModal" role="dialog" aria-labelledby="ingredientModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingredientModalLabel">New Ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!!csrf_field()!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="Ingredients-name">Ingredients name</label>
                            <input type="text" id="Ingredients-name" class="form-control form-control-sm col-md-12" name="Ingredients-name">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label for="Ingredients-qty">Quantity(Item stocks)</label>
                            <input type="text" id="Ingredients-qty" class="form-control form-control-sm col-md-12" name="Ingredients-qty">
                        </div>
                        <div class="col-sm-6">
                            <label for="stocktype">Type of Stock</label>
                            <select name="stocktype" id="stocktype" class="form-control form-control-sm">                    
                                <option value="1">pecies</option>
                                <option value="2">kilogram</option>                    
                            </select>
                        </div>            
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveIngredients">Save changes</button>
            </div>
        </div>
    </div>
</div>