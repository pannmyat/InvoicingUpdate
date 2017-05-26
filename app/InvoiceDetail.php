<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use App\InvoiceHeader;

	class InvoiceDetail extends Model
	{
		protected $fillable = ['item','quantity','price','amount','invoice_header_id'];	

		public function InvoiceHeader()
		{
			return $this->belongsTo(InvoiceHeader::class);
		}   
	}
?>