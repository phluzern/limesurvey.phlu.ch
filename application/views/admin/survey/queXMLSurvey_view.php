<div class="side-body col-lg-8">
            <h3>
                <?php eT("queXML PDF export");?>
            </h3>
             <?php echo CHtml::form(array("admin/export/sa/quexml/surveyid/{$surveyid}/"), 'post'); ?>
                <div class="form-group row"><label class="col-sm-2 control-label" for='save_language'><?php eT("Language selection"); ?></label>
<div class="col-sm-10">
                    <select class="form-control" name='save_language'>
                    <?php foreach ($slangs as $lang)
                    {
                        if ($lang == $baselang) { ?>
                           <option value='<?php echo $lang; ?>' selected='selected'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                        <?php }
                        else { ?>
                            <option value='<?php echo $lang; ?>'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                            <?php }
                    } ?>
                    </select>
                </div>
</div>
                
                 <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLStyle'><?php eT("Style:"); ?></label>
<div class="col-sm-10">
            
            <textarea class="form-control" rows="10" cols="80" id='queXMLStyle' name='queXMLStyle'><?php echo $queXMLStyle; ?> </textarea>
        </div>
</div>


        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLAllowSplittingSingleChoiceHorizontal'><?php eT("Allow array style questions to be split over multiple pages"); ?></label>
<div class="col-sm-10">
            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                'name' => 'queXMLAllowSplittingSingleChoiceHorizontal',
                'value'=> $queXMLAllowSplittingSingleChoiceHorizontal == 1,
                'onLabel'=>gT('Yes'),
                'offLabel'=>gT('No')));
            ?>
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLAllowSplittingSingleChoiceVertical'><?php eT("Allow single choice questions to be split over multiple pages"); ?></label>
<div class="col-sm-10">

            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                'name' => 'queXMLAllowSplittingSingleChoiceVertical',
                'value'=> $queXMLAllowSplittingSingleChoiceVertical == 1,
                'onLabel'=>gT('Yes'),
                'offLabel'=>gT('No')));
            ?>
         </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLAllowSplittingMatrixText'><?php eT("Allow multiple short text / numeric questions to be split over multiple pages"); ?></label>
<div class="col-sm-10">

            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                'name' => 'queXMLAllowSplittingMatrixText',
                'value'=> $queXMLAllowSplittingMatrixText == 1,
                'onLabel'=>gT('Yes'),
                'offLabel'=>gT('No')));
            ?>
 
        </div>
</div>


        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLAllowSplittingVas'><?php eT("Allow slider questions to be split over multiple pages"); ?></label>
<div class="col-sm-10">

            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                'name' => 'queXMLAllowSplittingVas',
                'value'=> $queXMLAllowSplittingVas == 1,
                'onLabel'=>gT('Yes'),
                'offLabel'=>gT('No')));
            ?>
 
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLSingleResponseAreaHeight'><?php eT("Minimum height of single choice answer boxes"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLSingleResponseAreaHeight' name='queXMLSingleResponseAreaHeight' value="<?php echo $queXMLSingleResponseAreaHeight; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLSingleResponseHorizontalHeight'><?php eT("Minimum height of subquestion items"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLSingleResponseHorizontalHeight' name='queXMLSingleResponseHorizontalHeight' value="<?php echo $queXMLSingleResponseHorizontalHeight; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLQuestionnaireInfoMargin'><?php eT("Margin before questionnaireInfo element (mm)"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLQuestionnaireInfoMargin' name='queXMLQuestionnaireInfoMargin' value="<?php echo $queXMLQuestionnaireInfoMargin; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLResponseTextFontSize'><?php eT("Answer option / subquestion font size"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLResponseTextFontSize' name='queXMLResponseTextFontSize' value="<?php echo $queXMLResponseTextFontSize; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLResponseLabelFontSize'><?php eT("Answer label font size (normal)"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLResponseLabelFontSize' name='queXMLResponseLabelFontSize' value="<?php echo $queXMLResponseLabelFontSize; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLResponseLabelFontSizeSmall'><?php eT("Answer label font size (small)"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLResponseLabelFontSizeSmall' name='queXMLResponseLabelFontSizeSmall' value="<?php echo $queXMLResponseLabelFontSizeSmall; ?>" />
        </div>
</div>

        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLSectionHeight'><?php eT("Minimum section height (mm)"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLSectionHeight' name='queXMLSectionHeight' value="<?php echo $queXMLSectionHeight; ?>" />
        </div>
</div>


        <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLBackgroundColourSection'><?php eT("Background colour for sections (0 black - 255 white)"); ?></label>
<div class="col-sm-10">
            <input class="form-control" type='text' size='10' id='queXMLBackgroundColourSection' name='queXMLBackgroundColourSection' value="<?php echo $queXMLBackgroundColourSection; ?>" />
        </div>
</div>                

                <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLBackgroundColourQuestion'><?php eT("Background colour for questions (0 black - 255 white)"); ?></label>
<div class="col-sm-10">
                    <input class="form-control" type='text' size='10' id='queXMLBackgroundColourQuestion' name='queXMLBackgroundColourQuestion' value="<?php echo $queXMLBackgroundColourQuestion; ?>" />
                </div>
</div>

                <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLPageOrientation'><?php eT("Page orientation"); ?></label>
<div class="col-sm-10">
                    <select class="form-control" id='queXMLPageOrientation' name='queXMLPageOrientation'>
                        <option value='P'
                            <?php if ($queXMLPageOrientation == "P") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("Portrait"); ?></option>
                        <option value='L'
                            <?php if ($queXMLPageOrientation == "L") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("Landscape"); ?></option>
                    </select>
                </div>
</div>


               <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLPageFormat'><?php eT("Page format"); ?></label>
<div class="col-sm-10">
                    <select class="form-control" id='queXMLPageFormat' name='queXMLPageFormat'>
                        <option value='A4'
                            <?php if ($queXMLPageFormat == "A4") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("A4"); ?></option>
                        <option value='USLETTER'
                            <?php if ($queXMLPageFormat == "USLETTER") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("US Letter"); ?></option>
                        <option value='A3'
                            <?php if ($queXMLPageFormat == "A3") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("A3"); ?></option>
                    </select>
                </div>
</div>

              <div class="form-group row"><label class="col-sm-2 control-label" for='queXMLEdgeDetectionFormat'><?php eT("Edge detection format"); ?></label>
<div class="col-sm-10">
                    <select class="form-control" id='queXMLEdgeDetectionFormat' name='queXMLEdgeDetectionFormat'>
                        <option value='lines'
                            <?php if ($queXMLEdgeDetectionFormat == "lines") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("Corner lines"); ?></option>
                        <option value='boxes'
                            <?php if ($queXMLEdgeDetectionFormat == "boxes") { ?>
                                selected='selected'
                                <?php } ?>
                            ><?php eT("Corner boxes"); ?></option>
                   </select>
                </div>
</div>

            <input type='hidden' name='ok' value='Y' />
            <input type='submit' class="btn btn-default" value="<?php eT("queXML PDF export"); ?>" />
        </form>
             <?php echo CHtml::form(array("admin/export/sa/quexmlclear/surveyid/{$surveyid}/"), 'post');
            echo CHtml::htmlButton(gT('Reset to default settings'),array('type'=>'submit','class'=>'btn btn-default btn-xs'));?>
        </form>
    </div>
