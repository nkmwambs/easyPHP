<?php
echo $data;
?>
<p>Below are the functionalities offered in the Business Services Application:</p>
<dl>
    <dt onmouseover='showdd("help");' onmouseout='hidedd("help");'><?php echo a_tag("Business/helpdesk",img_tag("help.png"));?> Help Desk</dt>
    <dd id="help">This application is used by CKE staff to submit request for support from the Business Service</dd>
    
    <dt onmouseover='showdd("inventory");' onmouseout='hidedd("inventory");'><?php echo a_tag("Business/inventory",img_tag("inventory.png"));?> Inventory Manager</dt>
    <dd id='inventory'>This application is used the Business Services to Record  new purchases, track the value of assets, ownership and location of assets, Items due for disposal, vendors and their contacts</dd>
    
    <dt onmouseover='showdd("rooms");' onmouseout='hidedd("rooms");'><?php echo a_tag("Business/rooms",img_tag("home.png"));?> Rooms Manager</dt>
    <dd id='rooms'>This application is used by the CKE staff to make reservations for meeting rooms</dd>    
    
    <dt onmouseover='showdd("library");' onmouseout='hidedd("library");'><?php echo a_tag("Business/library",img_tag("book.png"));?> Library Manager</dt>
    <dd id='library'>This application is used to track books, videos, DVDs and recording new library items</dd>       
        
    <dt onmouseover='showdd("facilities");' onmouseout='hidedd("facilities");'><?php echo a_tag("Business/facilities",img_tag("manage.png"));?> Facilities Manager</dt>
    <dd id='facilities'>This application is used to record and notify the administrator on regular maintenance of facilities e.g. Vehicles, Equipment and Building</dd>
        
    <dt onmouseover='showdd("letters");' onmouseout='hidedd("letters");'><?php echo a_tag("Business/letters",img_tag("mail.png"));?> Letters Tracker</dt>
    <dd id='letters'>This application records and track documents received by the administrator and users respectively</dd>
        
    <dt onmouseover='showdd("vendors");' onmouseout='hidedd("vendors");'><?php echo a_tag("Business/vendors",img_tag("info.png"));?> Vendors' Information</dt>
    <dd id='vendors'>This application stores and allows for search of current vendors  and their contacts</dd>    
        
    <dt onmouseover='showdd("vehicles");' onmouseout='hidedd("vehicles");'><?php echo a_tag("Business/vehicles",img_tag("car.png"));?> Vehicle Request</dt>
    <dd id='vehicles'>This application staff to book for vehicles</dd>    
</dl>


