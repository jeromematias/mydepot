<!-- Stocks modal -->    
<div class="modal fade" id="StocksModal" role="dialog" aria-labelledby="StocksMOdal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CategoryModalLabel">Stock IN and OUT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-4" id="tabreport1">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#SPanel" role="tab" aria-controls="SPanel">Stock in & out</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#SInventory" role="tab" aria-controls="SInventory">Sales Inventory</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#PLog" role="tab" aria-controls="PLog">Purchase Logs</a>
                    </li>
                  </ul>                  
                  <div class="tab-content">
                    <div class="tab-pane active" id="SPanel" role="tabpanel">
                      <div id="stockpanel" class="table-responsive"></div>
                    </div>                
                    <div class="tab-pane" id="SInventory" role="tabpanel">
                      <div id="salesinventory" class="table-responsive"></div>
                    </div>                
                    <div class="tab-pane" id="PLog" role="tabpanel">
                      <div id="purchaselog" class="table-responsive"></div>
                    </div>
                  </div>
                </div>  
            </div>
            <div class="modal-footer">
                <div class="btn-group" id="stockbtns">
                    <label>Quantity:</label>
                    <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="stockQty" class="form-control form-control-sm" placeholder="">
                    <button type="button" class="btn bg-gold" data-id="add" id="SaveStock">Add</button>
                    <button type="button" class="btn bg-gold" data-id="remove" id="RemoveStock">Remove</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>                            
            </div>
        </div>
    </div>
</div>