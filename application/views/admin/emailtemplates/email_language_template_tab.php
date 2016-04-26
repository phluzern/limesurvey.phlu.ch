
<div id='<?php echo "tab-$grouplang-$tab"; ?>' class="tab-pane fade in <?php echo $active; ?>">
    <div class='form-group'>
        <div class='col-sm-4 col-sm-offset-2'>
            <?php echo CHtml::link(sprintf(gT("Validate expression in %s"),$details['title']),array('admin/validate','sa'=>'email','sid'=>$surveyid,'lang'=>$grouplang,'type'=>$tab),array('title'=>$details['title'],"target"=>"dialog")); ?>
        </div>
    </div>

    <div class='form-group'>
        <label class='col-sm-2 control-label' for='email_<?php echo $tab; ?>_subj_<?php echo $grouplang; ?>'><?php echo $details['subject'] ?></label>
        <div class='col-sm-4'>
            <?php echo CHtml::textField("email_{$tab}_subj_{$grouplang}",$esrow->$details['field']['subject'],array('class' => 'form-control', 'size'=>80)); ?>
        </div>
        <div class='col-sm-1'>
            <?php echo CHtml::button(gT("Reset"),array('class'=>'fillin btn btn-default','data-target'=>"email_{$tab}_subj_{$grouplang}",'data-value'=>$details['default']['subject'])); ?>
        </div>
    </div>

    <div class='form-group'>
        <label class='col-sm-2 control-label' for='email_<?php echo $tab; ?>_<?php echo $grouplang; ?>'><?php echo $details['body']; ?></label>
        <div class='col-sm-4'>
            <?php echo CHtml::textArea("email_{$tab}_{$grouplang}",$esrow->$details['field']['body'],array('cols'=>80,'rows'=>20, 'class'=>'form-control')); ?>
            <?php echo getEditor("email-$tab","email_{$tab}_$grouplang", $details['body'].'('.$grouplang.')',$surveyid,'','','editemailtemplates'); ?>
        </div>
        <div class='col-sm-6'></div>
    </div>
    <div class='form-group'>
        <div class='col-sm-2'></div>
        <div class='col-sm-1'>
            <?php
            $details['default']['body']=($tab=='admin_detailed_notification') ? $details['default']['body'] : conditionalNewlineToBreak($details['default']['body'],$ishtml) ;
            echo CHtml::button(gT("Reset"),array('class'=>'fillin btn btn-default','data-target'=>"email_{$tab}_{$grouplang}",'data-value'=>$details['default']['body']));
            ?>
        </div>
        <div class='col-sm-9'></div>
    </div>
    <?php
    if (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'update'))
    { ?>
        <div class='form-group'>
            <label class='control-label col-sm-2' for="attachments_<?php echo "{$grouplang}-{$tab}"; ?>"><?php echo $details['attachments']; ?></label>
            <div class='col-sm-10'>
                <button class="add-attachment btn btn-default" id="add-attachment-<?php echo "{$grouplang}-{$tab}"; ?>"><?php eT("Add file"); ?></button>
            </div>
        </div>

        <?php } ?>
    <div class='form-group'>
        <div class='col-sm-5 col-sm-offset-2'>
            <table data-template="[<?php echo $grouplang; ?>][<?php echo $tab ?>]" id ="attachments-<?php echo $grouplang; ?>-<?php echo $tab ?>" class="attachments" style="width: 100%;">
                <tr>
                    <th><?php eT("Action"); ?></th>
                    <th><?php eT("File name"); ?></th>
                    <th><?php eT("Size"); ?></th>
                    <th><?php eT("Relevance"); ?></th>
                </tr>
                <?php

                if (isset($esrow->attachments[$tab]))
                {
                    $script = array();
                    foreach ($esrow->attachments[$tab] as $attachment)
                    {

                        $script[] = sprintf("addAttachment($('#attachments-%s-%s'), %s, %s, %s );", $grouplang, $tab, json_encode($attachment['url']), json_encode($attachment['relevance']), json_encode($attachment['size']));
                    }
                    echo '<script type="text/javascript">';
                    echo '$(document).ready(function() {';
                    echo implode("\n", $script);
                    echo '});';
                    echo '</script>';
                }
                ?>
            </table>
        </div>
    </div>
</div>
