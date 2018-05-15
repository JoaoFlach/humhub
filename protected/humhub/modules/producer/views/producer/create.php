<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <p>Create a producer</p>
    
    <form id="createProducerForm" action="/humhub/producer/rest/create" method="post">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" class="form-control"/>
            
            <label class="control-label">Internet address</label>
            <input type="text" name="internet_address" class="form-control"/>
            
            <label class="control-label">Country</label>
            <input type="text" name="country" class="form-control"/>
            
            <label class="control-label">Tags</label>
            <input type="" name="tags" class="form-control"/>
            
            <div class="row" id="channels">
                <label class="control-label">Channels</label>
                <div class="col-md-4">
                    
                    <input type='text' name='channel' class='form-control col-md-4'/>
                </div>                            
            </div>
            
            <input type="button" name="addchannel" value="Add Channel" onclick="addChannel()"/>
            <input type="button" name="viewform" value="View" onclick="viewForm()"/>
        </div>
        <input type="submit" value="Submit"/>
    </form>    
</div>

<script type="text/javascript">
        var counter = 1;
    
    function addChannel(){
        var input = "<input type='text' name='channel' class='form-control'/>";
//        input+= counter;
//        input+= "' class='form-control'/>";
//        counter++;
        $("#channels").append(input);
    }
    
    function viewForm(){
        var formData = JSON.stringify($("#createProducerForm").serializeArray());
        
        alert(formData);
    }
</script>
   