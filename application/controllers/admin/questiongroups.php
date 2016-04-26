<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * LimeSurvey
 * Copyright (C) 2007-2011 The LimeSurvey Project Team / Carsten Schmitz
 * All rights reserved.
 * License: GNU/GPL License v2 or later, see LICENSE.php
 * LimeSurvey is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 *
 */

/**
 * questiongroup
 *
 * @package LimeSurvey
 * @author
 * @copyright 2011
  * @access public
 */
class questiongroups extends Survey_Common_Action
{

    /**
     * questiongroup::import()
     * Function responsible to import a question group.
     *
     * @access public
     * @return void
     */
    function import()
    {
        $action = $_POST['action'];
        $iSurveyID = $surveyid =  $aData['surveyid'] = (int)$_POST['sid'];

        if (!Permission::model()->hasSurveyPermission($surveyid,'surveycontent','import'))
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(array('admin/survey/sa/listquestiongroups/surveyid/' . $surveyid));
        }

        if ($action == 'importgroup')
        {
            $importgroup = "\n";
            $importgroup .= "\n";

            $sFullFilepath = Yii::app()->getConfig('tempdir') . DIRECTORY_SEPARATOR . randomChars(20);
            $aPathInfo = pathinfo($_FILES['the_file']['name']);
            $sExtension = $aPathInfo['extension'];

            if (!@move_uploaded_file($_FILES['the_file']['tmp_name'], $sFullFilepath))
            {
                $fatalerror = sprintf(gT("An error occurred uploading your file. This may be caused by incorrect permissions in your %s folder."), $this->config->item('tempdir'));
            }

            // validate that we have a SID
            if (!returnGlobal('sid'))
                $fatalerror .= gT("No SID (Survey) has been provided. Cannot import question.");

            if (isset($fatalerror))
            {
                @unlink($sFullFilepath);
                Yii::app()->user->setFlash('error', $fatalerror);
                $this->getController()->redirect(array('admin/questiongroups/sa/importview/surveyid/' . $surveyid));
            }

            Yii::app()->loadHelper('admin/import');

            // IF WE GOT THIS FAR, THEN THE FILE HAS BEEN UPLOADED SUCCESFULLY
            if (strtolower($sExtension) == 'lsg')
            {
                $aImportResults = XMLImportGroup($sFullFilepath, $iSurveyID);
            }
            else
            {
                Yii::app()->user->setFlash('error', gT("Unknown file extension"));
                $this->getController()->redirect(array('admin/questiongroups/sa/importview/surveyid/' . $surveyid));
            }
            LimeExpressionManager::SetDirtyFlag(); // so refreshes syntax highlighting
            fixLanguageConsistency($iSurveyID);

            if (isset($aImportResults['fatalerror']))
            {
                unlink($sFullFilepath);
                Yii::app()->user->setFlash('error', $aImportResults['fatalerror']);
                $this->getController()->redirect(array('admin/questiongroups/sa/importview/surveyid/' . $surveyid));
            }

            unlink($sFullFilepath);

            $aData['display'] = $importgroup;
            $aData['surveyid'] = $iSurveyID;
            $aData['aImportResults'] = $aImportResults;
            $aData['sExtension'] = $sExtension;
            //$aData['display']['menu_bars']['surveysummary'] = 'importgroup';
            $aData['sidemenu']['state'] = false;

            $surveyinfo = Survey::model()->findByPk($iSurveyID)->surveyinfo;
            $aData['title_bar']['title'] = $surveyinfo['surveyls_title']."(".gT("ID").":".$iSurveyID.")";

            $this->_renderWrappedTemplate('survey/QuestionGroups', 'import_view', $aData);
        }
    }

    /**
     * Import a question group
     *
     */
    function importView($surveyid)
    {
        $iSurveyID = $surveyid = sanitize_int($surveyid);
        if (Permission::model()->hasSurveyPermission($surveyid,'surveycontent','import'))
        {

            $aData['action'] = $aData['display']['menu_bars']['gid_action'] = 'addgroup';
            $aData['display']['menu_bars']['surveysummary'] = 'addgroup';
            $aData['sidemenu']['state'] = false;
            $aData['sidemenu']['questiongroups'] = true;

            $aData['surveybar']['closebutton']['url'] = 'admin/survey/sa/listquestiongroups/surveyid/'.$surveyid;  // Close button
            $aData['surveybar']['savebutton']['form'] = true;
            $aData['surveyid'] = $surveyid;


            $surveyinfo = Survey::model()->findByPk($iSurveyID)->surveyinfo;
            $aData['title_bar']['title'] = $surveyinfo['surveyls_title']."(".gT("ID").":".$iSurveyID.")";

            $this->_renderWrappedTemplate('survey/QuestionGroups', 'importGroup_view', $aData);
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(array('admin/survey/sa/listquestiongroups/surveyid/' . $surveyid));
        }
    }

    /**
     * questiongroup::add()
     * Load add new question group screen.
     * @return
     */
    function add($surveyid)
    {
        /////
        $iSurveyID = $surveyid = sanitize_int($surveyid);
        $aViewUrls = $aData = array();

        if (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'create'))
        {
            Yii::app()->session['FileManagerContext'] = "create:group:{$surveyid}";

            Yii::app()->loadHelper('admin/htmleditor');
            Yii::app()->loadHelper('surveytranslator');
            $grplangs = Survey::model()->findByPk($surveyid)->additionalLanguages;
            $baselang = Survey::model()->findByPk($surveyid)->language;
            $grplangs[] = $baselang;
            $grplangs = array_reverse($grplangs);
            App()->getClientScript()->registerScriptFile( App()->getAssetManager()->publish( ADMIN_SCRIPT_PATH . 'questiongroup.js' ));

            $aData['display']['menu_bars']['surveysummary'] = 'addgroup';
            $aData['surveyid'] = $surveyid;
            $aData['action'] = $aData['display']['menu_bars']['gid_action'] = 'addgroup';
            $aData['grplangs'] = $grplangs;
            $aData['baselang'] = $baselang;

            $aData['sidemenu']['state'] = false;
            $surveyinfo = Survey::model()->findByPk($iSurveyID)->surveyinfo;
            $aData['title_bar']['title'] = $surveyinfo['surveyls_title']."(".gT("ID").":".$iSurveyID.")";
            $aData['surveybar']['importquestiongroup'] = true;
            $aData['surveybar']['closebutton']['url'] = 'admin/survey/sa/listquestiongroups/surveyid/'.$surveyid;  // Close button
            $aData['surveybar']['savebutton']['form'] = true;
            $aData['surveybar']['saveandclosebutton']['form'] = true;
            $this->_renderWrappedTemplate('survey/QuestionGroups', 'addGroup_view', $aData);
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Insert the new group to the database
     *
     * @access public
     * @param int $surveyid
     * @return void
     */
    public function insert($surveyid)
    {
        if (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'create'))
        {
            Yii::app()->loadHelper('surveytranslator');

            $grplangs = Survey::model()->findByPk($surveyid)->additionalLanguages;
            $baselang = Survey::model()->findByPk($surveyid)->language;

            $grplangs[] = $baselang;
            $errorstring = '';
            foreach ($grplangs as $grouplang)
                if (empty($_POST['group_name_' . $grouplang]))
                    $errorstring.= getLanguageNameFromCode($grouplang, false) . "\\n";

            if ($errorstring != '')
                $this->getController()->redirect(array('admin/survey/sa/view/surveyid/' . $surveyid));

            else
            {
                $first = true;
                foreach ($grplangs as $grouplang)
                {
                    //Clean XSS
                    $group_name = $_POST['group_name_' . $grouplang];
                    $group_description = $_POST['description_' . $grouplang];

                    $group_name = html_entity_decode($group_name, ENT_QUOTES, "UTF-8");
                    $group_description = html_entity_decode($group_description, ENT_QUOTES, "UTF-8");

                    // Fix bug with FCKEditor saving strange BR types
                    $group_name = fixCKeditorText($group_name);
                    $group_description = fixCKeditorText($group_description);


                    if ($first)
                    {
                        $aData = array(
                            'sid' => $surveyid,
                            'group_name' => $group_name,
                            'description' => $group_description,
                            'group_order' => getMaxGroupOrder($surveyid),
                            'language' => $grouplang,
                            'randomization_group' => $_POST['randomization_group'],
                            'grelevance' => $_POST['grelevance'],
                        );

                        $group = new QuestionGroup;
                        foreach ($aData as $k => $v)
                        {
                            $group->$k = $v;
                        }
                        $group->save();
                        $groupid = $group->gid;
                        $first = false;
                    }
                    else
                    {
                        switchMSSQLIdentityInsert('groups',true);
                        $aData = array(
                            'gid' => $groupid,
                            'sid' => $surveyid,
                            'group_name' => $group_name,
                            'description' => $group_description,
                            'group_order' => getMaxGroupOrder($surveyid),
                            'language' => $grouplang,
                            'randomization_group' => $_POST['randomization_group']
                        );

                        $group = new QuestionGroup;
                        foreach ($aData as $k => $v)
                        {
                            $group->$k = $v;
                        }
                        $group->save();
                        switchMSSQLIdentityInsert('groups',false);
                    }
                }
                // This line sets the newly inserted group as the new group
                if (isset($groupid))
                {
                    $gid = $groupid;
                }
                else
                {
                    // Error, redirect back.
                    Yii::app()->setFlashMessage(gT("Question group was not saved. Please check if the survey is active."), 'error');
                    $this->getController()->redirect(Yii::app()->request->urlReferrer);
                }

                $questions = new Question('search');
                $questions->gid = $gid;
                Yii::app()->setFlashMessage(gT("New question group was saved."));

                if($questions->search()->itemCount<1)
                {
                    Yii::app()->setFlashMessage(gT('You can now add a question in this group.'),'warning');
                    sprintf(gT("Q1 and Q3 calculated using %s"), "<a href='http://mathforum.org/library/drmath/view/60969.html' target='_blank'>".gT("minitab method")."</a>");
                }

            }

            // http://local.lsinst/LimeSurvey_206/index.php/admin/survey/sa/view/surveyid/282267/gid/10
            // http://local.lsinst/LimeSurvey_206/index.php//282267/gid/10

            if(Yii::app()->request->getPost('close-after-save') === 'true')
            {
                $this->getController()->redirect(array('admin/questiongroups/sa/view/surveyid/' . $surveyid . '/gid/' . $gid));
            }
            else
            {
                // After save, go to edit
                $this->getController()->redirect(array("admin/questiongroups/sa/edit/surveyid/$surveyid/gid/$gid"));
            }
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Action to delete a question group.
     *
     * @access public
     * @return void
     */
    public function delete($iSurveyId, $iGroupId)
    {
        $iSurveyId = sanitize_int($iSurveyId);

        if (Permission::model()->hasSurveyPermission($iSurveyId, 'surveycontent', 'delete'))
        {
            LimeExpressionManager::RevertUpgradeConditionsToRelevance($iSurveyId);

            $iGroupId = sanitize_int($iGroupId);
            $iGroupsDeleted = QuestionGroup::deleteWithDependency($iGroupId, $iSurveyId);

            if ($iGroupsDeleted > 0)
            {
                fixSortOrderGroups($iSurveyId);
                Yii::app()->setFlashMessage(gT('The question group was deleted.'));
            }
            else
                Yii::app()->setFlashMessage(gT('Group could not be deleted'),'error');
            LimeExpressionManager::UpgradeConditionsToRelevance($iSurveyId);
            $this->getController()->redirect(array('admin/survey/sa/listquestiongroups/surveyid/' . $iSurveyId ));
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function view($surveyid, $gid)
    {
        $aData = array();
        $aData['surveyid'] = $iSurveyID = $surveyid;
        $aData['gid'] = $gid;
        $baselang = Survey::model()->findByPk($surveyid)->language;
        $condarray = getGroupDepsForConditions($surveyid, "all", $gid, "by-targgid");
        $aData['condarray'] = $condarray;

        $grow = QuestionGroup::model()->findByPk(array('gid' => $gid, 'language' => $baselang));
        $grow = $grow->attributes;

        $grow = array_map('flattenText', $grow);

        $aData['surveyid'] = $surveyid;
        $aData['gid'] = $gid;
        $aData['grow'] = $grow;

        $aData['sidemenu']['questiongroups'] = true;
        $aData['sidemenu']['group_name'] = $grow['group_name'];
        $surveyinfo = Survey::model()->findByPk($iSurveyID)->surveyinfo;
        $aData['title_bar']['title'] = $surveyinfo['surveyls_title']."(".gT("ID").":".$iSurveyID.")";
        $aData['questiongroupbar']['buttons']['view'] = true;

        ///////////
        // sidemenu
        $aData['sidemenu']['state'] = true;
        $aData['sidemenu']['explorer']['state'] = true;
        $aData['sidemenu']['explorer']['gid'] = (isset($gid))?$gid:false;
        $aData['sidemenu']['explorer']['qid'] = false;

        $this->_renderWrappedTemplate('survey/QuestionGroups', 'group_view', $aData);
    }

    /**
     * questiongroup::edit()
     * Load editing of a question group screen.
     *
     * @access public
     * @param int $surveyid
     * @param int $gid
     * @return void
     */
    public function edit($surveyid, $gid)
    {
        $surveyid = $iSurveyID = sanitize_int($surveyid);
        $gid = sanitize_int($gid);
        $aViewUrls = $aData = array();

        if (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'update'))
        {
            Yii::app()->session['FileManagerContext'] = "edit:group:{$surveyid}";

            Yii::app()->loadHelper('admin/htmleditor');
            Yii::app()->loadHelper('surveytranslator');

            $aAdditionalLanguages = Survey::model()->findByPk($surveyid)->additionalLanguages;
            // TODO: This is not an array, but a string "en"
            $aBaseLanguage = Survey::model()->findByPk($surveyid)->language;

            $aLanguages = array_merge(array($aBaseLanguage), $aAdditionalLanguages);

            $grplangs = array_flip($aLanguages);

            // Check out the intgrity of the language versions of this group
            $egresult = QuestionGroup::model()->findAllByAttributes(array('sid' => $surveyid, 'gid' => $gid));
            foreach ($egresult as $esrow)
            {
                $esrow = $esrow->attributes;

                // Language Exists, BUT ITS NOT ON THE SURVEY ANYMORE
                if (!in_array($esrow['language'], $aLanguages))
                {
                    QuestionGroup::model()->deleteAllByAttributes(array('sid' => $surveyid, 'gid' => $gid, 'language' => $esrow['language']));
                }
                else
                {
                    $grplangs[$esrow['language']] = 'exists';
                }

                if ($esrow['language'] == $aBaseLanguage)
                    $basesettings = $esrow;
            }

            // Create groups in missing languages
            while (list($key, $value) = each($grplangs))
            {
                if ($value != 'exists')
                {
                    $basesettings['language'] = $key;
                    $group = new QuestionGroup;
                    foreach ($basesettings as $k => $v)
                        $group->$k = $v;
                    switchMSSQLIdentityInsert('groups', true);
                    $group->save();
                    switchMSSQLIdentityInsert('groups', false);
                }
            }
            $first = true;
            foreach ($aLanguages as $sLanguage)
            {
                $oResult = QuestionGroup::model()->findByAttributes(array('sid' => $surveyid, 'gid' => $gid, 'language' => $sLanguage));
                $aData['aGroupData'][$sLanguage] = $oResult->attributes;
                $aTabTitles[$sLanguage] = getLanguageNameFromCode($sLanguage, false);
                if ($first)
                {
                    $aTabTitles[$sLanguage].= ' (' . gT("Base language") . ')';
                    $first = false;
                }
            }

            $aData['sidemenu']['questiongroups'] = true;
            $aData['questiongroupbar']['savebutton']['form'] = true;
            $aData['questiongroupbar']['saveandclosebutton']['form'] = true;
            $aData['questiongroupbar']['closebutton']['url'] = 'admin/questiongroups/sa/view/surveyid/'.$surveyid.'/gid/'.$gid;  // Close button

            $aData['action'] = $aData['display']['menu_bars']['gid_action'] = 'editgroup';
            $aData['surveyid'] = $surveyid;
            $aData['gid'] = $gid;
            $aData['tabtitles'] = $aTabTitles;
            $aData['aBaseLanguage'] = $aBaseLanguage;

            $surveyinfo = Survey::model()->findByPk($iSurveyID)->surveyinfo;
            $aData['title_bar']['title'] = $surveyinfo['surveyls_title']."(".gT("ID").":".$iSurveyID.")";

            ///////////
            // sidemenu
            $aData['sidemenu']['state'] = false;
            $aData['sidemenu']['explorer']['state'] = true;
            $aData['sidemenu']['explorer']['gid'] = (isset($gid))?$gid:false;
            $aData['sidemenu']['explorer']['qid'] = false;

            $this->_renderWrappedTemplate('survey/QuestionGroups', 'editGroup_view', $aData);
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(Yii::app()->request->urlReferrer);
        }

    }

    /**
     * Provides an interface for updating a group
     *
     * @access public
     * @param int $gid
     * @return void
     */
    public function update($gid)
    {
        $gid = (int) $gid;

        $group = QuestionGroup::model()->findByAttributes(array('gid' => $gid));
        $surveyid = $group->sid;

        if (Permission::model()->hasSurveyPermission($surveyid, 'surveycontent', 'update'))
        {
            Yii::app()->loadHelper('surveytranslator');

            $grplangs = Survey::model()->findByPk($surveyid)->additionalLanguages;
            $baselang = Survey::model()->findByPk($surveyid)->language;

            array_push($grplangs, $baselang);

            foreach ($grplangs as $grplang)
            {
                if (isset($grplang) && $grplang != "")
                {
                    $group_name = $_POST['group_name_' . $grplang];
                    $group_description = $_POST['description_' . $grplang];

                    $group_name = html_entity_decode($group_name, ENT_QUOTES, "UTF-8");
                    $group_description = html_entity_decode($group_description, ENT_QUOTES, "UTF-8");

                    // Fix bug with FCKEditor saving strange BR types
                    $group_name = fixCKeditorText($group_name);
                    $group_description = fixCKeditorText($group_description);

                    $aData = array(
                        'group_name' => $group_name,
                        'description' => $group_description,
                        'randomization_group' => $_POST['randomization_group'],
                        'grelevance' => $_POST['grelevance'],
                    );
                    $condition = array(
                        'gid' => $gid,
                        'sid' => $surveyid,
                        'language' => $grplang
                    );
                    $group = QuestionGroup::model()->findByAttributes($condition);
                    foreach ($aData as $k => $v)
                        $group->$k = $v;
                    $ugresult = $group->save();
                    if ($ugresult)
                    {
                        $groupsummary = getGroupList($gid, $surveyid);
                    }
                }
            }

            Yii::app()->session['flashmessage'] = gT("Question group successfully saved.");

            if(Yii::app()->request->getPost('close-after-save') === 'true')
                $this->getController()->redirect(array('admin/questiongroups/sa/view/surveyid/' . $surveyid . '/gid/' . $gid));

            $this->getController()->redirect(array('admin/questiongroups/sa/edit/surveyid/' . $surveyid . '/gid/' . $gid));
        }
        else
        {
            Yii::app()->user->setFlash('error', gT("Access denied"));
            $this->getController()->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Renders template(s) wrapped in header and footer
     *
     * @param string $sAction Current action, the folder to fetch views from
     * @param string|array $aViewUrls View url(s)
     * @param array $aData Data to be passed on. Optional.
     */
    protected function _renderWrappedTemplate($sAction = 'survey/QuestionGroups', $aViewUrls = array(), $aData = array())
    {
        parent::_renderWrappedTemplate($sAction, $aViewUrls, $aData);
    }
}
