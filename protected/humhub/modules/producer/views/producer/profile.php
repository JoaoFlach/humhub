<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <h2>Producer profile</h2>
    
    <div>
        <p>Name: <?= $producer->name ?></p
        <p>Guid: <?= $producer->guid ?></p>
        <p>Internet Address: <?= $producer->internet_address ?></p>
        <p>Country: <?= $producer->country ?></p>
        <p>Tags: <?= $producer->tags ?></p>
        <p>Created at: <?= $producer->created_at ?></p>
        <p>Created by: <?= $producer->user_id ?></p>
    </div>
</div>
   