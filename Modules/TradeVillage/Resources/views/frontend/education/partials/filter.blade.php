<div class="filter-group">
	<button class="filter-item">{{ trans('tradevillage::main.filter.favorite') }}<span class="glyphicon glyphicon glyphicon-sort"></span></button>
</div>
<div class="filter-group">
	<table>
		<tr>
			<td><p class="filter-item">{{ trans('tradevillage::main.filter.category') }}</p></td>
			<td>
				<select class="form-control filter-item">
					@foreach($categories as $category)
			        <option value={{ $category->village_fields_id }}>
			        	{{ $category->translate(locale())->name }}
			        </option>
			        @endforeach
			    </select>
			</td>
		</tr>
	</table>
</div>