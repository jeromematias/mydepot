<table class="table table-hover" id="tableIngredientsInventory" cellpadding="0" cellspacing="0" width="100%">
    <thead class="bg-gold">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>AVAILABLE STOCKS</th>
            <th>SOLD ITEM</th>
        </tr>
    </thead>
    <tbody class="table-sm">
        @foreach ($GetIngredientsInventory as $menu)
        <tr>
            <td>{{ $menu->item_id }}</td>
            <td>{{ $menu->item_name }}</td>
            <td>{{ $menu->avialablestocks }}</td>
            <td>{{ $menu->soldquantity }}</td>            
        </tr>
        @endforeach
    </tbody>
</table><!--<div class="col-sm-7">
	<table class="table table-hover" id="tableIngredientsInventory" cellpadding="0" cellspacing="0" width="100%">
		    <thead class="bg-light">
		        <tr>
		            <th>ID</th>
		            <th>NAME</th>
		            <th>AVAILABLE STOCKS</th>
		            <th>SOLD ITEM</th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach ($GetIngredientsInventory as $menu)
		        <tr>
		            <td>{{ $menu->item_id }}</td>
		            <td>{{ $menu->item_name }}</td>
		            <td>{{ $menu->avialablestocks }}</td>
		            <td>{{ $menu->soldquantity }}</td>            
		        </tr>
		        @endforeach
		    </tbody>
		</table>
</div>
<div class="col-sm-5" id="DatePanel">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Date Start</label>
                <input type="text" class="form-control" name="">
                <label>Date End</label>
                <input type="text" class="form-control" name="">
                <button class="btn btn-warning col-sm-12" id="showreport">Show Report</button>                
                
            </div>
        </div>
    </div>
</div>-->