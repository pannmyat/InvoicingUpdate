<!DOCTYPE html>
<html>
<head>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<title>Invoice</title>
	<style>
	    .table { display: table; width: 100%; border-collapse: collapse; }
	    .table-row { display: table-row; }
	    .table-cell { display: table-cell; border: 1px solid black; padding: 5px; }
	    .table-Total-cell { display: table-cell; border: 1px solid black; padding: 5px;margin-left: 200px; }
	 </style>
</head>
<body>
	<div class="container">
		<h1>Invoice</h1>
		<hr>
		<b><label>Invoice Name :</label> <label>{{$data->invoice_name}}</label></b>
		<br>
		<b><label>Cashier Name :</label> <label>{{ Auth::user()->name }}</label></b>
		<br>
		<br>
		<div class="table">
		    <div class="table-row">
		      <div class="table-cell"><b>Item</b></div>
		      <div class="table-cell"><b>Price</b></div>
		      <div class="table-cell"><b># of Items</b></div>
		      <div class="table-cell"><b>Amount</b></div>
		    </div>
		    <?php for($i=0;$i<count($data->Invoices);$i++){ ?>
			    <div class="table-row">
			      <div class="table-cell">{{$data->Invoices[$i]->item}}</div>
			      <div class="table-cell">{{$data->Invoices[$i]->price}}</div>
			      <div class="table-cell">{{$data->Invoices[$i]->quantity}}</div>
			      <div class="table-cell">{{$data->Invoices[$i]->amount}}</div>
			    </div>
			<?php } ?>
			<div class="table-row">
				<div class="table-cell"></div>
		      	<div class="table-cell"></div>
		      	<div class="table-cell" style="text-align:right;"><b>SubTotal :</b></div>
		      	<div class="table-cell">{{$data->subtotal}}</div>
			</div>
			<div class="table-row">
				<div class="table-cell"></div>
		      	<div class="table-cell"></div>
		      	<div class="table-cell" style="text-align:right;"><b>Tax :</b></div>
		      	<div class="table-cell">{{$data->tax}}%</div>
			</div>
			<div class="table-row">
				<div class="table-cell"></div>
		      	<div class="table-cell"></div>
		      	<div class="table-cell" style="text-align:right;"><b>Total :</b></div>
		      	<div class="table-cell">{{$data->total}}</div>
			</div>
		</div>		
	</div>	
</body>
</html>