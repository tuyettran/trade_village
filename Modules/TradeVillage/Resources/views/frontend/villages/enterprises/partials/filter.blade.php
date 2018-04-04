<div class="filter-group">
	<table>
		<tr>
			<td><p class="filter-item">{{ trans('tradevillage::main.filter.category') }}</p></td>
			<td>
				{!! Form::open(['route' => ['frontend.tradevillage.search.enterprise.category'], 'method' => 'get', 'id' =>'category-form'] ) !!}
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
			    {{ Form::close() }}
			</td>
		</tr>
	</table>
</div>
<div class="filter-group">
	<table>
		<tr>
			<td><p class="filter-item">{{ trans('tradevillage::main.filter.province') }}</p></td>
			<td>
				<select class="form-control filter-item">
			        <option value="1">
			        	Ha noi
			        </option>
			        <option>
			        	Hai phong
			        </option>
			    </select>
			</td>
		</tr>
	</table>
</div>