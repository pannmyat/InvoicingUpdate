@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html>
<head>	
	<title>New Invoice</title>		
</head>

<div class="tabs is-toggle">
  <ul>
    <li class="is-active">
      <a href="#">
        <span class="icon is-small"><i class="fa fa-image"></i></span>
        <span>UPDATE INVOICE</span>
      </a>
    </li>
    <li>
      <a href="{{ url('invoices/create') }}">
        <span class="icon is-small"><i class="fa fa-music"></i></span>
        <span>INVOICE LISTING</span>
      </a>
    </li>    
  </ul>
</div>

<body id="app">
	<div class="container">
		<form method="POST" action="{{ url('invoices/edit') }}/@{{Invoiceno}}">
			 {{ csrf_field() }}
			 <input name="_method" type="hidden" value="PUT">
			 <label>Invoice Name : </label><input type="text" name="invoice_name" placeholder="Invoice Name" v-model="invoicename">
			 <input type="hidden" name="InvoiceNo" v-model='Invoiceno'>
			 <button type="button" class="button is-primary" onclick="window.location='{{ url("/") }}'" style='height:30px;float:right;'>New Invoice</button>
			 <br>
			 <br>
			 <div class="box">
				 <ul>			
					<li>
						<label style="padding-right:70px;">Item Name</label>
						<label style="padding-right:80px;"># of items</label>
						<label style="padding-right:120px;">Price</label>
						<label style="padding-right:0px;">Total</label>				
					</li>	
				</ul>				
				
				<ul v-show="listStatus">
					<li v-for="(key, item) in Item">
						<input type="hidden" name="<?php echo "Detail[{{ key+1 }}][id]" ?>" v-model="item.id">					
						<input type="text" name="<?php echo "Detail[{{ key+1 }}][item]" ?>" v-model="item.item" placeholder="Item Name">
						<input type="number" name="<?php echo"Detail[{{ key+1 }}][quantity]" ?>" v-model="item.quantity" placeholder="quantity">
						<input type="number" name="<?php echo"Detail[{{ key+1 }}][price]" ?>" v-model="item.price" placeholder="price">
						<input type="number" name="<?php echo "Detail[{{ key+1 }}][amount]" ?>" v-model="item.amount" placeholder="amount" value="@{{ item.quantity * item.price }}" readonly>
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" v-on:click="removeElement(key,item.id)" style='height:30px;'>Del</button>										
					</li>
				</ul>
					
				<hr>
				<ul>
					<li><input type="hidden" name="user_id" v-model='user_id' readonly></li>
					<li><input type="hidden" name="total_qty"  v-model="totalQty" value='@{{ totalQty }}' readonly></li>					
					<li><label style="padding-left:400px;">SubTotal:</label><input type="number" name="subtotal"  placeholder="Sub Total" value='@{{ subtotal }}' readonly></li>
				 	<li><label style="padding-left:439px;">Tax:</label><input type="number" name="tax" placeholder="Tax" v-model="tax">%</li>
				 	<li><label style="padding-left:427px;">Total:</label><input type="number" name="total" placeholder="Total" value='@{{ subtotal  + ((subtotal/100)*tax) }}' readonly></li>
				 				  		 			 			  
				</ul>				
			</div>
					
			<button type="submit" class="button is-primary">Update</button>

		</form>
		<br>
		<br>		

		@include("layouts.error")
		
	</div>	
	
	<script type="text/javascript" src="{{url('/')}}/js/vue.js"></script>
	<script>
		new Vue({
		    el: '#app',
		    data: {		    	 		         
		         Item: {!! $header->Invoices !!},
		         listResult: '',
		         tax:'{{ $header->tax }}',
		         invoicename:'{{ $header->invoice_name }}',
		         Invoiceno:'{{ $header->id }}',
		         user_id:{{ Auth::user()->id }}		        
		    },
		    computed: {		    	 	
			    listStatus: function () {
			      return (this.Item.length > 0) ? true : false; 
			    },
			    amount:function(){
			    	return this.Item.item.quantity * this.Item.item.price;
			    },
			    totalQty:function(){			    	
				    return this.Item.reduce(function(quantity, item){
				        return quantity + (item.quantity * 1);
		          },0);     
			    },
			   	subtotal: function(){
				        return this.Item.reduce(function(amount, item){
				        return amount + (item.quantity * item.price);
		          },0);
		        }		        		        
	        },			
		    methods: {
		    	optionClick: function() {
		    		this.Item.push({
		    			id:'',
		    			item: '',
		    			quantity: '',
		    			price: '',
		    			amount:'',
		    		});
		    	},

		    	removeElement: function (index) {
				    this.Item.splice(index, 1);				   		   	   			    
				},
	    	
		    }
		})
	</script>
</body>
</html>
@endsection