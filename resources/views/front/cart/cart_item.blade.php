@php
	
	use App\Models\Product;	
@endphp
<table class="table table-bordered">
  <thead>
                  <tr>
                    <th>Product</th>
                    <th colspan="2">Description</th>
                    <th>Quantity/Update</th>
                    <th>MRP</th>
                    {{-- <th>Product Price</th> --}}
                    <th>Category /  Product <br>Discount</th>
                    <th>Sub Total</th>
                  </tr>
  </thead>
  <tbody>
                  @php
                      $total_price = 0;
                  @endphp
                  @foreach($userCartItems as $item)
                  @php
                      $getAttributePrice = Product::getDiscountAttrPrice($item['product_id'],$item['size']);
                  @endphp
                  <tr>
                      <td> <img width="60" src="{{asset('front/images/products/small/'.$item['product']['product_image'])}}" alt=""/></td>
                      <td colspan="2">{{$item['product']['product_name']}} {{$item['product']['product_code']}}<br/>Color : {{$item['product']['product_color']}}<br>
                      Size : {{$item['size']}}</td>
                      <td>
                      <div class="input-append">
                        <input class="span1" name="quantity" value="{{$item['quantity']}}" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text">
                        <button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{$item['id']}}"><i class="icon-minus"></i></button>
                        <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$item['id']}}"><i class="icon-plus"></i></button>
                        <button class="btn btn-danger btnItemDelete" type="button" data-cartid="{{$item['id']}}"><i class="icon-remove icon-white"></i></button>				
                      </div>
                      </td>
                      <td>$.{{$getAttributePrice['price']}}</td>
                      <td>$.{{$getAttributePrice['discount']}}</td>
                      <td>$.{{$item['quantity'] * $getAttributePrice['discount_price']}}</td>
                    
                  </tr>
                  @php
                      $total_price = $total_price + ($getAttributePrice['discount_price'] * $item['quantity']);
                  @endphp
                  @endforeach

                  
          
                  <tr>
                    <td colspan="6" style="text-align:right">Sub Total:	</td>
                    <td> Rs.{{$total_price}}</td>
                  </tr>
          <tr>
                    <td colspan="6" style="text-align:right">Voucher Discount:	</td>
                    <td> Rs.0.00</td>
                  </tr>
                  <tr>
                    <td colspan="6" style="text-align:right">Total Tax:	</td>
                    <td> Rs.0.00</td>
                  </tr>
          <tr>
                    <td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Rs.{{$total_price}} - Rs.0 + Rs.0) =</strong></td>
                    <td class="label label-important" style="display:block"> <strong> Rs.{{$total_price}} </strong></td>
                  </tr>
  </tbody>
</table>