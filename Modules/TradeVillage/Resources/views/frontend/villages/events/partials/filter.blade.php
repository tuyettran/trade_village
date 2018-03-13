@include('tradevillage::frontend.education.partials.filter', ['categories' => $categories])
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