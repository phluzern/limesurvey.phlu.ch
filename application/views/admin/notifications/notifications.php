<div id="notif-container" class="col-lg-12 content-right" style="z-index: 10100">
    <?php foreach($aMessage as $message):?>
        <?php
            if(isset($message['type']) && in_array($message['type'],array('error','success','danger','warning','info')))
            {
                $sType=$message['type'];
                if($sType=='error')
                {
                    $sType='danger';
                }
            }
            else
            {
                $sType='success';
            }
            echo CHtml::openTag("div",array('class'=>"alert alert-{$sType} alert-dismissible",'role'=>'alert'));
            echo CHtml::htmlButton("<span >&times;</span>",array('type'=>'button','class'=>'close','data-dismiss'=>'alert','aria-label'=>gT("Close")));
            echo $message['message'];
            echo CHtml::closeTag("div");
        ?>
    <?php endforeach;?>
</div>
