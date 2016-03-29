<?php
/**
 * Result of a token post action
 */
?>

<div class="side-body">                           
    <div class="row">                             
        <div class="col-lg-12 content-right">

            <!-- Success -->
            <?php if ($success): ?>
                <div class="jumbotron message-box">
                    <h2>Add token entry</h2>
                    <p class="lead text-success"><?php eT("Success"); ?></p>
                    <p><?php eT("New token was added."); ?></p>
                    <p>
                        <input class="btn btn-large btn-default" type='button' value='<?php eT("Display tokens"); ?>' onclick="window.open('<?php echo $this->createUrl("admin/tokens/sa/browse/surveyid/$surveyid"); ?>', '_top')" /><br />
                        <input class="btn btn-large btn-default" type='button' value='<?php eT("Add another token entry"); ?>' onclick="window.open('<?php echo $this->createUrl("admin/tokens/sa/addnew/surveyid/$surveyid"); ?>', '_top')" /><br />        
                    </p>
                </div>
                
            <!-- Fail -->    
            <?php else:?>
                <div class="jumbotron message-box message-box-error">
                    <h2 class="text-danger">Add token entry</h2>
                    <p class="lead text-danger"><?php eT("Failed"); ?></p>
                    <p><?php eT("There is already an entry with that exact token in the table. The same token cannot be used in multiple entries."); ?></p>
                    <p>
                        <input type='button' class="btn btn-large brn-default" value='<?php eT("Display tokens"); ?>' onclick="window.open('<?php echo $this->createUrl("admin/tokens/sa/browse/surveyid/$surveyid"); ?>', '_top')" /><br />
                        <input type='button' class="btn btn-large brn-default" value='<?php eT("Add new token entry"); ?>' onclick="window.open('<?php echo $this->createUrl("admin/tokens/sa/addnew/surveyid/$surveyid"); ?>', '_top')" /><br />
                    </p>
                </div>    
            <?php endif;?>
        </div>
    </div>
</div>