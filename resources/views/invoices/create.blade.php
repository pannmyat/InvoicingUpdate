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
        <span>New INVOICE</span>
      </a>
    </li>
    <li>
      <a href="{{ url('/invoices/show') }}">
        <span class="icon is-small"><i class="fa fa-music"></i></span>
        <span>INVOICE LISTING</span>
      </a>
    </li>    
  </ul>
</div>

<body id="app">
	<div class="container">		
		<form method="POST" action="{{ url('/invoices/create') }}">
			 {{ csrf_field() }}
			 <label>Invoice Name : </label><input type="text" name="invoice_name" placeholder="Invoice Name">
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
				<ul>			
					<li>
						<input type="text" name="Detail[0][item]" placeholder="Item Name">
						<input type="number" name="Detail[0][quantity]"  v-model="quantity" placeholder="quantity">
						<input type="number" name="Detail[0][price]" placeholder="price"  v-model="price">
						<input type="number" name="Detail[0][amount]" placeholder="amount"  v-model="amount" value="@{{ quantity * price }}" readonly>						
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" style='height:30px;'>Del</button>				
					</li>	
				</ul>		

				<ul v-show="listStatus">
					<li v-for="(key, item) in list">					
						<input type="text" name="<?php echo "Detail[{{ key+1 }}][item]" ?>" v-model="item.item" placeholder="Item Name">
						<input type="number" name="<?php echo "Detail[{{ key+1 }}][quantity]" ?>"  v-model="item.quantity" placeholder="quantity">
						<input type="number" name="<?php echo "Detail[{{ key+1 }}][price]" ?>" v-model="item.price" placeholder="price">
						<input type="number" name="<?php echo "Detail[{{ key+1 }}][amount]" ?>" v-model="item.amount" placeholder="amount" value="@{{ item.quantity * item.price }}" readonly>
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" v-on:click="removeElement(key)" style='height:30px;'>Del</button>										
					</li>
				</ul>
				<hr>
				<ul>
					<li><input type="hidden" name="user_id" v-model='user_id' readonly></li>
					<li><input type="hidden" name="total_qty"  value='@{{ totalQty + (quantity * 1) }}' readonly></li>
					<li><label style="padding-left:400px;">SubTotal:</label><input type="number" name="subtotal"  placeholder="Sub Total" value='@{{ subtotal + (quantity * price) }}' readonly></li>
				 	<li><label style="padding-left:439px;">Tax:</label><input type="number" name="tax" placeholder="Tax" value=0 v-model="tax">%</li>
				 	<li><label style="padding-left:427px;">Total:</label><input type="number" name="total" placeholder="Total" value='@{{ subtotal + (quantity * price) + ((subtotal/100)*tax) + (((quantity * price)/100)*tax) }}' readonly></li>
				 				  		 			 			  
				</ul>				
			</div>
					
			<button type="submit" class="button is-primary">Save</button>		
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
		         list: [],
		         listResult: '',
		         user_id:{{ Auth::user()->id }}
		    },
		    computed: {
			    listStatus: function () {
			      return (this.list.length > 0) ? true : false; 
			    },
			    amount:function(){
			    	return this.list.item.quantity * this.list.item.price;
			    },

			    totalQty:function(){			    	
				     return this.list.reduce(function(quantity, item){
				        return quantity + (item.quantity * 1);
		          },0);       
			    },
			    
				subtotal: function(){
				        return this.list.reduce(function(amount, item){
				        return amount + (item.quantity * item.price);
		          },0);
		        }
	        },			
		    methods: {
		    	optionClick: function() {
		    		this.list.push({
		    			item: '',
		    			quantity: '',
		    			price: '',
		    			amount:'',
		    		});
		    	},

		    	removeElement: function (index) {
				    this.list.splice(index, 1);
				}	    	
		    }
		})
	</script>
</body>
</html>
@endsection