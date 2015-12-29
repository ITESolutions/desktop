<?php

class Form {
    public $action;
    
    public function __construct() {
        $this->action = $_SERVER;
    }
}

class Invoice {
    public $id;
    private $invoice_num, $contact_id;
    
}

?>
<h1>Invoices</h1>
<hr>
<form action="">
    <label for="invoice_num">Invoice Number</label>
    <input
        type="text"
        placeholder="Invoive Number"
        id="invoice_num"
        name="invoice_num"
        value="201512241509"
        />
    <br>
    <label for="bill_to">Bill To</label>
    <input
        type="text"
        placeholder="Name or Company"
        id="bill_to"
        name="bill_to"
        value="Happy Go Enterprises"
        />
    <br>
    <label for="bill_address">Address</label>
    <input
        type="text"
        placeholder="Address"
        id="bill_address"
        name="bill_address[]"
        value="123 Comfort Blvd"
        />
    <br>
    <label for="bill_city">City</label>
    <input
        type="text"
        placeholder="City"
        id="bill_city"
        name="bill_city"
        value="Lafayette"
        />
    <label for="bill_state">State</label>
    <input
        type="text"
        placeholder="State"
        id="bill_state"
        name="bill_state"
        value="IN"
        />
    <label for="bill_zip">Zip</label>
    <input
        type="text"
        placeholder="Zip"
        id="bill_zip"
        name="bill_zip"
        value="47905"
        />
    
    
        
</form>
