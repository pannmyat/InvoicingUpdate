<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use App\InvoiceDetail;

	class InvoiceHeader extends Model
	{
	   	protected $fillable = ['invoice_name','user_id','total_qty','subtotal','tax','total'];

	   	public function Invoices()
		{
			return $this->hasMany(InvoiceDetail::class);
		}		
	}
?>