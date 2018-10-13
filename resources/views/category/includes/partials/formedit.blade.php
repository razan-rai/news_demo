
<div class="">Customer Form</div>
<hr>
<div class="form-group">
    {{ Form::label('customer_name', 'Customer Name', ['class' => 'control-label col-sm-2']) }}

    <div class="col-sm-10">
        {{ Form::text('customer_name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Customer Name']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('customer_phone_no', 'Customer Ph. Number', ['class' => 'control-label col-sm-2']) }}

    <div class="col-sm-10">
        {{ Form::text('customer_phone_no', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Customer Ph. Number']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('customer_address', 'Customer Address', ['class' => 'control-label col-sm-2']) }}

    <div class="col-sm-10">
        {{ Form::text('customer_address', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Customer Address']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('customer_email', 'Customer E-mail', ['class' => 'control-label col-sm-2']) }}

    <div class="col-sm-10">
        {{ Form::text('customer_email', null, ['class' => 'form-control', 'maxlength' => '191', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Customer E-mail']) }}
    </div>
</div>

<div class="">Order Form</div>
<hr>
<!-- order form begins -->
  
  
<div class="panel panel-default">
		<div class="panel-body">
		   <div class="form-group">
				<div class="col-sm-3 nopadding">
				     <label for="quantity" class="control-label col-sm-2">Quantity (KG)</label>
				</div>

				<div class="col-sm-3 nopadding">
				  <label class="col-sm-2 control-label">Service Type:</label>
				</div>

				<div class="col-sm-3 nopadding">
				  <label class="col-sm-2 control-label">Goods Type:</label>
				</div>

				<div class="col-sm-3 nopadding">
				  <label class="col-sm-2 control-label">Order Type:</label>
				</div>
			</div>
			
			<div id="orderwrap">
			@foreach($edit_customer_detail->orderDetail as $key =>  $orderDetails)
			<input type="hidden" id="orderkey" name="last_arry" data-keyid="{{ $key }}">
			<div class="form-group">
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <input type="text" class="form-control" id="quantity" name="quantity[]" value="{{ $orderDetails->quantity }}" placeholder="Enter Quantity">
				  </div>
				</div>
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <select class="form-control m-bot15" name="service_id[]">
			        @foreach($serviceLists as $service)
			        @if(trim($orderDetails->service_name) == trim($service->service_name))
			        <option value="{{$service->id}}" selected><strong>{{$service->service_name}}</strong></option>
			        @else
			            <option value="{{$service->id}}">{{$service->service_name}}</option>
			        @endif
			        @endforeach
			        </select>
				  </div>
				</div>
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <select class="form-control m-bot15" name="goods_id[{{$key }}][]" id="goodssss" multiple="multiple">
			        @foreach($goodsLists as $goods)
			        @if( ! empty($edit_product->sub_category_id) == $goods->id)
			        <option value="{{$goods->id}}" selected><strong>{{$goods->name}}</strong></option>
			        @else
			            <option value="{{$goods->id}}">{{$goods->name}}</option>
			        @endif
			        @endforeach
			        </select>
				  </div>
				</div>

				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <div class="input-group">
				      <select class="form-control m-bot15" name="ordertype_id[]">
				        @foreach($ordertypes as $order)
				        @if( trim($orderDetails->order_type) == trim($order->order_type))
				        <option value="{{$order->id}}" selected><strong>{{$order->order_type}}</strong></option>
				        @else
				            <option value="{{$order->id}}">{{$order->order_type}}</option>
				        @endif
				        @endforeach
				        </select>
				        <div class="input-group-btn"> 
				        	<a class="btn btn-danger pading" href="{{ URL::to('admin/customer/orders/' . $orderDetails->id) }}"
				             data-method="delete"
				             data-trans-button-cancel="Cancel"
				             data-trans-button-confirm="Delete"
				             data-trans-title="Are you sure to delete"
				             class="btn btn-danger"><i class="icon_close_alt2" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
						</div>
				    </div>
				  </div>
				</div>
			</div>
			@endforeach
			<div class="form-group">
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <input type="text" class="form-control" id="Schoolname" name="quantity[]" value="" placeholder="Enter Quantity">
				  </div>
				</div>
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <select class="form-control m-bot15" name="service_id[]">
			        @foreach($serviceLists as $service)
			        @if( ! empty($edit_product->sub_category_id) == $service->id)
			        <option value="{{$service->id}}" selected><strong>{{$service->service_name}}</strong></option>
			        @else
			            <option value="{{$service->id}}">{{$service->service_name}}</option>
			        @endif
			        @endforeach
			        </select>
				  </div>
				</div>
				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <select class="asignvalue form-control m-bot15" name="" id="goodssss" multiple="multiple">
			        @foreach($goodsLists as $goods)
			        @if( ! empty($edit_product->sub_category_id) == $goods->id)
			        <option value="{{$goods->id}}" selected><strong>{{$goods->name}}</strong></option>
			        @else
			            <option value="{{$goods->id}}">{{$goods->name}}</option>
			        @endif
			        @endforeach
			        </select>
				  </div>
				</div>

				<div class="col-sm-3 nopadding">
				  <div class="form-group">
				    <div class="input-group">
				      <select class="form-control m-bot15" name="ordertype_id[]">
				        @foreach($ordertypes as $order)
				        @if( ! empty($edit_product->sub_category_id) == $order->id)
				        <option value="{{$order->id}}" selected><strong>{{$order->order_type}}</strong></option>
				        @else
				            <option value="{{$order->id}}">{{$order->order_type}}</option>
				        @endif
				        @endforeach
				        </select>
				      <div class="input-group-btn">
				        <button class="btn btn-success pading" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
		<div id="education_fields"></div>
		</div>
	  </div>
</div>

          
