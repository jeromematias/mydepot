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
                      <a class="nav-link active" data-toggle="tab" href="#SPanel" role="tab" aria-controls="SPanel">STOCKS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#SStocks" role="tab" aria-controls="SStocks">STOCK IN/OUT</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#SInventory" role="tab" aria-controls="SInventory">SALES INVENTORY</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#PLog" role="tab" aria-controls="PLog">PURCHASE LOG</a>
                    </li>
                  </ul>                  
                  <div class="tab-content">
                    <div class="tab-pane active" id="SPanel" role="tabpanel">
                      <div id="stockpanel" class="table-responsive"></div>
                    </div>                
                    <div class="tab-pane active" id="SStocks" role="tabpanel">
                      <div id="stockinout" class="table-responsive"></div>
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
                    <input type="text" id="stockQty" class="form-control form-control-sm" placeholder="">
                    <select class="form-control" id="deliverystatus">
                      <option value="0">Delivery Type</option>
                      <option value="1">Delivery in</option>
                      <option value="2">Damaged</option>
                      <option value="3">Dispose</option>
                    </select>
                    <button type="button" class="btn bg-gold" data-id="add" id="SaveStock">Add</button>
                    <button type="button" class="btn bg-gold" data-id="remove" id="RemoveStock">Remove</button>
                    <button type="button" class="btn bg-primary" data-id="remove" id="PrintStock">Print Stocks</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="btn-group" id="stockdate">
                    <label for="filterdate">Date:</label>
                    <input type="text" id="filterdate" class="form-control form-control-sm" placeholder="YYYY-MM-DD HH:MM:SS">
                    <button type="button" class="btn bg-gold" data-id="remove" id="GenSales">Generate Sales</button>
                    <button type="button" class="btn bg-primary" id="PrintSales">Print Sales</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>