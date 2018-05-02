<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <p>Create a producer</p>
    
    <form action="/humhub/producer/rest/create" method="post">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" class="form-control"/>
            
            <label class="control-label">Internet address</label>
            <input type="text" name="internet_address" class="form-control"/>
            
            <label class="control-label">Country</label>
            <input type="text" name="country" class="form-control"/>
            
            <label class="control-label">Tags</label>
            <input type="" name="tags" class="form-control"/>
        </div>
        <input type="submit" value="Submit"/>
    </form>
</div>
   