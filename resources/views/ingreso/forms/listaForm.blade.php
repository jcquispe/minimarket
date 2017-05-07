<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> DETALLE DE COMPRA</h3>
    </div>
    <div class="panel-body">
        <!--{!!Form::button('NUEVO',['class'=>'btn btn-default', 'id'=>'add'])!!}-->
        <input type="text" id="indice" name="indice" value="0" hidden>
        <div class="table-responsive">
            <table class="tablew" id="ingreso">
    			<thead>
    				<tr>
    					<th >CODIGO</th>
    					<th >PRODUCTO</th>
    					<th >MEDIDA</th>
    					<th >CANTIDAD</th>
    					<th style="font-size:12px">C.UNIDAD</th>
    					<th style="font-size:12px">C.TOTAL</th>
    				</tr>
    			</thead>
    			<tbody id="tcuerpo">
    				<tr>
    					<td ><select class="codigo" name="codigo0" id="0">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto0" id="producto0" disabled></td>
    					<td ><input type="text" name="unidad0" id="unidad0" disabled></td>
    					<td ><input type="text" name="cantidad0" id="cantidad0" value="0" class="cantidad"></td>
    					<td ><input type="text" name="costou0" id="costou0" value="0" class="costo"></td>
    					<td ><input type="text" name="costot0" id="costot0" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo1" id="1">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto1" id="producto1" disabled></td>
    					<td><input type="text" name="unidad1" id="unidad1" disabled></td>
    					<td><input type="text" name="cantidad1" id="cantidad1" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou1" id="costou1" value="0" class="costo"></td>
    					<td><input type="text" name="costot1" id="costot1" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo2" id="2">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto2" id="producto2" disabled></td>
    					<td><input type="text" name="unidad2" id="unidad2" disabled></td>
    					<td><input type="text" name="cantidad2" id="cantidad2" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou2" id="costou2" value="0" class="costo"></td>
    					<td><input type="text" name="costot2" id="costot2" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo3" id="3">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto3" id="producto3" disabled></td>
    					<td><input type="text" name="unidad3" id="unidad3" disabled></td>
    					<td><input type="text" name="cantidad3" id="cantidad3" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou3" id="costou3" value="0" class="costo"></td>
    					<td><input type="text" name="costot3" id="costot3" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo4" id="4">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto4" id="producto4" disabled></td>
    					<td><input type="text" name="unidad4" id="unidad4" disabled></td>
    					<td><input type="text" name="cantidad4" id="cantidad4" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou4" id="costou4" value="0" class="costo"></td>
    					<td><input type="text" name="costot4" id="costot4" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo5" id="5">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto5" id="producto5" disabled></td>
    					<td><input type="text" name="unidad5" id="unidad5" disabled></td>
    					<td><input type="text" name="cantidad5" id="cantidad5" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou5" id="costou5" value="0" class="costo"></td>
    					<td><input type="text" name="costot5" id="costot5" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo6" id="6">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto6" id="producto6" disabled></td>
    					<td><input type="text" name="unidad6" id="unidad6" disabled></td>
    					<td><input type="text" name="cantidad6" id="cantidad6" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou6" id="costou6" value="0" class="costo"></td>
    					<td><input type="text" name="costot6" id="costot6" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo7" id="7">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto7" id="producto7" disabled></td>
    					<td><input type="text" name="unidad7" id="unidad7" disabled></td>
    					<td><input type="text" name="cantidad" id="cantidad4" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou7" id="costou7" value="0" class="costo"></td>
    					<td><input type="text" name="costot7" id="costot7" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo8" id="8">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto8" id="producto8" disabled></td>
    					<td><input type="text" name="unidad8" id="unidad8" disabled></td>
    					<td><input type="text" name="cantidad8" id="cantidad8" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou8" id="costou8" value="0" class="costo"></td>
    					<td><input type="text" name="costot8" id="costot8" class="total" disabled></td>
    				</tr>
    				
    				<tr>
    					<td ><select class="codigo" name="codigo9" id="9">
    					    <option value="">--Código--</option>
    					    @foreach($productos as $prod)
    					    <option value={{$prod->id}}>{{$prod->codigo}}</option>
    					    @endforeach
    					</select></td>
    					<td ><input type="text" name="producto9" id="producto9" disabled></td>
    					<td><input type="text" name="unidad9" id="unidad9" disabled></td>
    					<td><input type="text" name="cantidad9" id="cantidad9" value="0" class="cantidad"></td>
    					<td><input type="text" name="costou9" id="costou9" value="0" class="costo"></td>
    					<td><input type="text" name="costot9" id="costot9" class="total" disabled></td>
    				</tr>
    				
    			</tbody>
    		</table>
        </div>
    </div>
</div>

