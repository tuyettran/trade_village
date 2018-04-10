<div class="filter-group">
	<table>
		<tr>
			<td><p class="filter-item">{{ trans('tradevillage::main.filter.category') }}</p></td>
			<td>
				<select class="form-control filter-item" id="category_select" name="category">
					<option value=0 {{ isset($category)? '' : 'selected' }}>
				        {{ trans('tradevillage::main.title.all') }}
				    </option>
					@if(isset($category))
						@foreach($categories as $cate)
					        <option value={{ $cate->id }} {{ $cate->id==$category->id? 'selected' : '' }} >
					        	{{ $cate->translate(locale())->name }}
					        </option>
				        @endforeach
				    @else
				    	@foreach($categories as $cate)
					        <option value={{ $cate->id }} >
					        	{{ $cate->translate(locale())->name }}
					        </option>
				        @endforeach
				    @endif
			    </select>
			</td>
		</tr>
	</table>
</div>
<div class="filter-group">
	<table>
		<tr>
			<td><p class="filter-item">{{ trans('tradevillage::main.filter.favorite') }}</p></td>
			<td>
				<select class="form-control filter-item" id="favorite_select" name="favorite">
					<option value="" >
						Sắp xếp
			        </option>
			        @if(isset($favorite))
						<option value="desc" {{ $favorite=='desc' ? 'selected' : '' }}>
							Giảm dần
				        </option>
				        <option value="asc"  {{ $favorite=='asc' ? 'selected' : '' }}>
				        	Tăng dần
				        </option>
				    @else
				    	<option value="desc">
							Giảm dần
				        </option>
				        <option value="asc" >
				        	Tăng dần
				        </option>
				    @endif
			    </select>
			</td>
		</tr>
	</table>
</div>