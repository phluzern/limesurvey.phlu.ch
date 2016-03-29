<?php
/**
 * Date Html, selector style :
 * @var $name                           $ia[1]
 * @var $qid                            $ia[0]
 * @var $iLength
 * @var $dateoutput
 * @var $mindate
 * @var $maxdate
 * @var $dateformatdetails              $dateformatdetails['dateformat']
 * @var $dateformatdetailsjs            $dateformatdetails['jsdate']
 * @var $goodchars                      return goodchars(event,'".$goodchars."')
 * @var $checkconditionFunction         $checkconditionFunction(this.value, this.name, this.type)
 * @var $language                       App()->language
 * @var $hidetip                        trim($aQuestionAttributes['hide_tip'])==0
 */
?>
<p class='question answer-item text-item date-item form-group'>
    <label for='answer<?php echo $name;?>' class='hide label'>
        <?php echo sprintf(gT('Date in the format: %s'),$dateformatdetails); ?>
    </label>

    <div class='col-xs-12 col-sm-6'>
        <input
            class='form-control popupdate'
            type="text"
            size="<?php echo $iLength;?>"
            name="<?php echo $name;?>"
            id="answer<?php echo $name;?>"
            value="<?php echo $dateoutput;?>"
            maxlength="<?php echo $iLength;?>"
            onkeypress="<?php echo $goodchars;?>"
            onchange="<?php echo $checkconditionFunction;?>"
        />
    </div>
    <div class='col-sm-6'></div>  <!-- Clear row -->

    <input
        type='hidden'
        name="dateformat<?php echo $name;?>"
        id="dateformat<?php echo $name;?>"
        value="<?php echo $dateformatdetailsjs;?>"
    />

    <input
        type='hidden'
        name="datelanguage<?php echo $name;?>"
        id="datelanguage<?php echo $name;?>"
        value="<?php echo $language;?>"
    />
</p>

<div class='hidden nodisplay' style='display:none'>
    <!-- Obs: No spaces in the div - it will mess up Javascript string parsing -->
    <div id='datemin<?php echo $name;?>'><?php echo $mindate; ?></div>
    <div id='datemax<?php echo $name;?>'><?php echo $maxdate; ?></div>
</div>

<?php if($hidetip):?>
    <div class='col-xs-12'>
        <p class="tip">
            <?php echo sprintf(gT('Format: %s'),$dateformatdetails); ?>
        </p>
    </div>
<?php endif;?>

<input type='hidden' class="namecontainer" data-name="<?php echo $qid; ?>" />
