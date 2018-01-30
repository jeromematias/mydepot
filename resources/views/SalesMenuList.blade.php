@if($list == 'list')
<table class="table table-hover" id="menuList" cellpadding="0" cellspacing="0" width="100%">
	<thead class="bg-secondary text-white">
		<tr>
			<th data-orderable="true">Name</th>
			<th data-orderable="false">Price</th>
			<th data-orderable="false">Category</th>
			<th data-orderable="false"></th>			
		</tr>
	</thead>
	<tbody class="table-lg">
		@foreach($menu as $i)		
		<tr data-id="{{ $i->menu_id }}">
			<td>{{ $i->name }}</td>
			<td>{{ $i->price }}</td>
			<td>{{ $i->category_name }}</td>
			<td>
				<button class="btn btn-lg" data-id="{{ $i->menu_id }}" id="btn-purchase" data-value="{{ $menu }}">PURCHASE</button>
			</td>
		</tr>
		@endforeach		
	</tbody>
</table>
@else
<div class="row" id="tilepanel">
  @foreach($menu as $i)
  <div class="col-sm-4">
    <div class="card" id="menutiles">
      <div class="card-body">
        <p class="card-title">{{ $i->name }}</p>
        <p class="card-text">Price : Php {{ $i->price }}</p>
        <button class="btn btn-primary col-sm-12" data-id="{{ $i->menu_id }}" id="btn-purchase" data-value="{{ $menu }}">Add</button>
      </div>
    </div>
  </div>
  @endforeach  
</div>
@endif