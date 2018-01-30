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
</table>