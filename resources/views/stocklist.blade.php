<table class="table table-hover" id="StockList" cellpadding="0" cellspacing="0" width="100%">
    <thead class="bg-gold">
        <tr>                        
            <th>Ingredient</th>
            <th class="text-center">Stocks</th>
            <th class="text-center" data-orderable="false">
                <input type="checkbox" name="select_all" id="select_all" value="">
            </th>
        </tr>
    </thead>
    <tbody class="table-sm">
    @foreach ($GetTblItems as $items)
        <tr data-id="row{{ $items->id }}">
            <td id="{{ $items->item_name }}">{{ $items->item_name }}</td>
            @if($items->type=="kilograms")
                @if($items->quantity>=1000)                                        
                    <td id="{{ $items->quantity }}" class="text-center">{{ number_format(($items->quantity /1000), 2, '.', ',') ." kg" }}</td>
                @else                    
                    <td id="{{ $items->quantity }}" class="text-center">{{ $items->quantity ." g" }}</td>
                @endif
            @elseif($items->type=="mililiter")
                @if($items->quantity>=1000)                                        
                    <td id="{{ $items->quantity }}" class="text-center">{{ number_format(($items->quantity /1000), 2, '.', ',') ." liter" }}</td>
                @else                    
                    <td id="{{ $items->quantity }}" class="text-center">{{ $items->quantity ." ml" }}</td>
                @endif
            @else                
                <td id="{{ $items->quantity }}" class="text-center">{{ $items->quantity ." pcs" }}</td>
            @endif            
            <td>
                <div class="btn-group">
                    <input type="checkbox" name="item_id" id="number" value="{{ $items->id }}">
                </div>
            </td>                                            
        </tr>   
    @endforeach     
    </tbdy>
</table>