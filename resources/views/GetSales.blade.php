<div class="col-sm-7" id="salesTable">
	<table class="table table-hover" id="tableSales" cellpadding="0" cellspacing="0" width="100%">
	    <thead class="bg-light">
	        <tr>
	            <th>ID</th>
	            <th>CATEGORY</th>
	            <th>NAME</th>
	            <th>PRICE</th>
	            <th>TOTAL SALES</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($SalesInventory as $menu)
	        <tr>
	            <td>{{ $menu->menu_id }}</td>
	            <td>{{ $menu->cat_name }}</td>
	            <td>{{ $menu->name }}</td>
	            <td>{{ $menu->price }}</td>
	            <td>{{ $menu->TotalPrice }}</td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>
</div>
<div class="col-sm-5" id="DatePanel">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
            	<label id="Lbl_totalSales">Total Sales: {{ $TotalSales[0]->TotalPrice }}</label><br/>
                <label>Date Start</label>
                <input type="text" class="form-control" name="">
                <label>Date End</label>
                <input type="text" class="form-control" name="">
                <button class="btn btn-warning col-sm-12" id="showreport">Show Report</button>                                
            </div>
        </div>
    </div>
</div>