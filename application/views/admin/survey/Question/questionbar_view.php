<?php
$aReplacementData=array();
?>

<div class='menubar surveybar' id="questionbarid">
    <div class='row container-fluid'>

        <?php if(isset($questionbar['buttons']['view'])):?>
        <div class="col-md-12">

            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','read')): ?>
                <?php if (count($languagelist) > 1): ?>

                    <!-- preview question -->
                    <!-- Single button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="icon-do"></span>
                        <?php eT("Preview"); ?> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" style="min-width : 252px;">
                          <?php foreach ($languagelist as $tmp_lang): ?>
                              <li>
                                  <a target="_blank" href='<?php echo $this->createUrl("survey/index/action/previewquestion/sid/" . $surveyid . "/gid/" . $gid . "/qid/" . $qid . "/lang/" . $tmp_lang); ?>' >
                                      <?php echo getLanguageNameFromCode($tmp_lang,false); ?>
                                  </a>
                              </li>
                          <?php endforeach; ?>
                      </ul>
                    </div>


                    <!-- preview group -->
                    <!-- Preview multilangue -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="icon-do"></span>
                        <?php eT("Preview its question group"); ?> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" style="min-width : 252px;">
                          <?php foreach ($languagelist as $tmp_lang): ?>
                              <li>
                                  <a target="_blank" href="<?php echo $this->createUrl("survey/index/action/previewgroup/sid/{$surveyid}/gid/{$gid}/lang/" . $tmp_lang); ?>" >
                                      <?php echo getLanguageNameFromCode($tmp_lang,false); ?>
                                  </a>
                              </li>
                          <?php endforeach; ?>
                      </ul>
                    </div>

                <?php else:?>

                    <!-- preview question -->
                    <a class="btn btn-default" href='<?php echo $this->createUrl("survey/index/action/previewquestion/sid/" . $surveyid . "/gid/" . $gid . "/qid/" . $qid); ?>' role="button" target="_blank">
                        <span class="icon-do"></span>
                        <?php eT("Preview");?>
                    </a>

                    <!-- preview question group -->
                    <a class="btn btn-default" href="<?php echo $this->createUrl("survey/index/action/previewgroup/sid/$surveyid/gid/$gid/"); ?>" role="button" target="_blank">
                        <span class="icon-do"></span>
                        <?php eT("Preview its question group");?>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a class="btn disabled" href="#" role="button">
                    <span class="icon-do"></span>
                    <?php eT("Preview");?>
                </a>
            <?php endif; ?>


            <!-- Edit button -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','update')): ?>
                <a class="btn btn-default" href='<?php echo $this->createUrl("admin/questions/sa/editquestion/surveyid/".$surveyid."/gid/".$gid."/qid/".$qid); ?>' role="button">
                    <span class="icon-edit"></span>
                    <?php eT("Edit");?>
                </a>
            <?php endif; ?>


            <!-- Check logic -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','read')): ?>
                <a class="btn btn-default" href="<?php echo $this->createUrl("admin/expressions/sa/survey_logic_file/sid/{$surveyid}/gid/{$gid}/qid/{$qid}/"); ?>" role="button">
                    <span class="icon-expressionmanagercheck"></span>
                    <?php eT("Check logic"); ?>
                </a>
            <?php endif; ?>


            <!-- Delete -->
            <?php if( $activated != "Y" && Permission::model()->hasSurveyPermission($surveyid,'surveycontent','delete' )):?>
                <a class="btn btn-default"
                   data-toggle="modal"
                   data-href="<?php echo $this->createUrl("admin/questions/sa/delete/surveyid/$surveyid/gid/$gid/qid/$qid"); ?>"
                   data-target="#confirmation-modal"
                   data-message="<?php eT("Deleting this question will also delete any answer options and subquestions it includes. Are you sure you want to continue?","js"); ?>"
                   >
                    <span class="glyphicon glyphicon-trash text-danger"></span>
                    <?php eT("Delete"); ?>
                </a>
            <?php elseif (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'delete')): ?>
                <a href='<?php echo $this->createUrl('admin/survey/sa/view/surveyid/'.$surveyid.'/gid/'.$gid.'/qid/'.$qid); ?>'
                    class="btn btn-default"
                    onclick="alert('<?php eT("You can't delete this question group because the survey is currently active.","js"); ?>')">
                    <span class="glyphicon glyphicon-trash"></span>
                    <?php eT("Delete current question group"); ?>
                </a>
            <?php endif; ?>


            <!-- export -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','export')):?>
                <a class="btn btn-default" href="<?php echo $this->createUrl("admin/export/sa/question/surveyid/$surveyid/gid/$gid/qid/$qid");?>" role="button">
                    <span class="icon-export"></span>
                    <?php eT("Export "); ?>
                </a>
            <?php endif; ?>

            <!-- copy -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','create')):?>
                <?php if(($activated != "Y")):?>
                    <a class="btn btn-default" href="<?php echo $this->createUrl("admin/questions/sa/copyquestion/surveyid/$surveyid/gid/$gid/qid/$qid");?>" role="button">
                        <span class="icon-copy"></span>
                        <?php eT("Copy"); ?>
                    </a>
                <?php else:?>
                    <a class="btn disabled" href="#" role="button" onclick="alert('<?php eT("You can't copy a question if the survey is active.","js"); ?>');">
                        <span class="icon-copy"></span>
                        <?php eT("Copy"); ?>
                    </a>
                <?php endif;?>
            <?php endif;?>

            <!-- conditions -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','update')):?>
                <a class="btn btn-default" href="<?php echo $this->createUrl("admin/conditions/sa/index/subaction/editconditionsform/surveyid/$surveyid/gid/$gid/qid/$qid"); ?>" role="button">
                    <span class="icon-conditions"></span>
                    <?php eT("Set conditions "); ?>
                </a>
            <?php endif;?>


            <!-- subquestions -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','update')):?>
                <?php if($qtypes[$qrrow['type']]['subquestions'] >0):?>
                    <a class="btn btn-default" href="<?php echo $this->createUrl('admin/questions/sa/subquestions/surveyid/'.$surveyid.'/gid/'.$gid.'/qid/'.$qid); ?>" role="button">
                        <span class="icon-defaultanswers"></span>
                        <?php eT("Edit subquestions "); ?>
                    </a>
                <?php endif;?>
            <?php endif;?>


            <!-- Answer Options -->
            <?php if( Permission::model()->hasSurveyPermission($surveyid,'surveycontent','update') && $qtypes[$qrrow['type']]['answerscales'] > 0 ):?>
                <a class="btn btn-default" href="<?php echo $this->createUrl('admin/questions/sa/answeroptions/surveyid/'.$surveyid.'/gid/'.$gid.'/qid/'.$qid); ?>" role="button">
                    <span class="icon-defaultanswers"></span>
                    <?php eT("Edit answer options "); ?>
                </a>
            <?php endif;?>


            <!-- Default Values -->
            <?php if(Permission::model()->hasSurveyPermission($surveyid,'surveycontent','read') && $qtypes[$qrrow['type']]['hasdefaultvalues'] >0):?>
                    <a class="btn btn-default" href="<?php echo $this->createUrl('admin/questions/sa/editdefaultvalues/surveyid/'.$surveyid.'/gid/'.$gid.'/qid/'.$qid); ?>" role="button">
                        <span class="icon-defaultanswers"></span>
                        <?php eT("Edit default answers"); ?>
                    </a>
            <?php endif;?>
    </div>
<?php endif;?>


<?php if(isset($questionbar['buttons']['conditions'])):?>
<div class="col-md-7">
    <a class="btn btn-default <?php if(isset($questionbar['buttons']['condition']['conditions'])){echo 'active';}?>" href="<?php echo $this->createUrl("/admin/conditions/sa/index/subaction/conditions/surveyid/$surveyid/gid/$gid/qid/$qid"); ?>" role="button">
        <span class="glyphicon glyphicon-info-sign"></span>
        <?php eT("Show conditions for this question");?>
    </a>

    <a class="btn btn-default <?php if(isset($questionbar['buttons']['condition']['edit']) && $questionbar['buttons']['condition']['edit']){ echo 'active'; }?>" href="<?php echo $this->createUrl("admin/conditions/sa/index/subaction/editconditionsform/surveyid/$surveyid/gid/$gid/qid/$qid"); ?>" role="button">
        <span class="icon-conditions_add"></span>
        <?php eT("Add and edit conditions");?>
    </a>

    <a class="btn btn-default <?php if(isset($questionbar['buttons']['condition']['copyconditionsform'])){echo 'active';}?>" href="<?php echo $this->createUrl("admin/conditions/sa/index/subaction/copyconditionsform/surveyid/$surveyid/gid/$gid/qid/$qid"); ?>" role="button">
        <span class="icon-copy"></span>
        <?php eT("Copy conditions");?>
    </a>
</div>
<?php endif;?>

        <div class="col-md-5 text-right form-inline">
                <?php if(isset($questionbar['savebutton']['form'])):?>


                    <?php if( 1==1 ):?>
                        <a class="btn btn-success" href="#" role="button">
                            <span class="glyphicon glyphicon-ok"></span>
                            <?php eT("Save");?>
                        </a>
                    <?php endif;?>

                    <a class="btn btn-default" href="<?php echo $this->createUrl("admin/survey/sa/listquestiongroups/surveyid/282267{$surveyid}"); ?>" role="button">
                        <span class="glyphicon glyphicon-saved"></span>
                        <?php eT("Save and close");?>
                    </a>
                <?php endif;?>


                <?php if(isset($questionbar['buttons']['conditions'])):?>

                    <div class="form-group">
                        <label for='questionNav'><?php eT("Move to question:");?></label>
                        <select id='questionNav' class="form-control"  onchange="window.open(this.options[this.selectedIndex].value,'_top')"><?php echo $quesitonNavOptions;?></select>
                    </div>

                <?php endif;?>

                <!-- Close -->
                <?php if(isset($questionbar['closebutton']['url'])):?>
                    <a class="btn btn-danger" href="<?php echo $questionbar['closebutton']['url']; ?>" role="button">
                        <span class="glyphicon glyphicon-close"></span>
                        <?php eT("Close");?>
                    </a>
                <?php endif;?>


                <?php if(isset($questionbar['returnbutton']['url'])):?>
                    <a class="btn btn-default" href="<?php echo $questionbar['returnbutton']['url']; ?>" role="button">
                        <span class="glyphicon glyphicon-step-backward"></span>
                        <?php echo $questionbar['returnbutton']['text'];?>
                    </a>
                <?php endif;?>
        </div>
        <?php if(isset($questionbar['savebuttonright'])):?>
            <div class="col-md-12 text-right form-inline">
                <!-- Save buttons -->
                <a class="btn btn-success" href="#" role="button" id="save-button">
                    <span class="glyphicon glyphicon-ok"></span>
                    <?php eT("Save");?>
                </a>
            </div>
        <?php endif;?>
    </div>
</div>
