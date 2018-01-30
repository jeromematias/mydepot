<table class="table table-hover" id="StockList" cellpadding="0" cellspacing="0">
    <thead class="bg-gold">
        <tr>                        
            <th>Ingredient</th>
            <th>Stocks</th>
            <th>Last added Stocks</th>
            <th>Last deducted Stocks</th>
            <th data-orderable="false">
                <input type="checkbox" name="select_all" id="select_all" value="">
            </th>
        </tr>
    </thead>
    <tbody class="table-sm">
    @foreach ($GetTblItems as $items)
        <tr data-id="row{{ $items->id }}">
            <td id="{{ $items->item_name }}">{{ $items->item_name }}</td>
            <td id="{{ $items->quantity }}" class="text-center">{{ $items->quantity }}</td>
            <td id="{{ $items->quantity }}" class="text-center">{{ $items->last_added }}</td>
            <td id="{{ $items->quantity }}" class="text-center">{{ $items->last_deduct }}</td>                                
            <td>
                <div class="btn-group">
                    <input type="checkbox" name="item_id" id="number" value="{{ $items->id }}">
                </div>
            </td>                                
        </tr>   
    @endforeach     
    </tbody>
</table>