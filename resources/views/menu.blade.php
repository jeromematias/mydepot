<table class="table table-hover" id="menuList" cellpadding="0" cellspacing="0" width="100%">
	<thead class="bg-gold">
		<tr>
			<th data-orderable="false"></th>
			<th data-orderable="false">Category</th>
			<th>Name</th>
			<th>Price</th>
			<th>Drinks</th>
			<th data-orderable="false"></th>
		</tr>
	</thead>
	<tbody class="table-sm">
		@foreach ($GetMenu as $menu)
			<tr data-id="row{{ $menu->menu_id }}">
				<td id="{{ $menu->menu_id }}">{{ $menu->menu_id }}</td>
				<td id="{{ $menu->cat_id }}">{{ $menu->category_name }}</td>
				<td id="{{ $menu->name }}">{{ $menu->name }}</td>
				<td id="{{ $menu->price }}"> Php {{ $menu->price }}</td>
				<td id="{{ $menu->drink_id }}">{{ $menu->drinksname }}</td>
				<td>
					<div class="btn-group">
						<button class="btn btn-primary btn-sm" id="updateMenu" data-value="[{'id': 'id','ingredientName': 'ingredientName','quantity': 'ingredientQty'}" data-id="{{ $menu->menu_id }}">update</button>						
					</div>
				</td>
			</tr>	
		@endforeach		
	</tbody>
</table>