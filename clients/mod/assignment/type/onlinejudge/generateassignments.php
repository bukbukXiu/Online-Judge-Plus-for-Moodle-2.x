<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
//                      Online Judge for Moodle                          //
//        https://github.com/hit-moodle/moodle-local_onlinejudge         //
//                                                                       //
// Copyright (C) 2009 onwards  Sun Zhigang  http://sunner.cn             //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Assignmemts generation
 *
 * @package   local_onlinejudge
 * @copyright 2015 Andrey Nadezhdin
 * @author    Andrey Nadezhdin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__).'/../../../../config.php');
require_once("$CFG->dirroot/mod/assignment/lib.php");
require_once('assignment.class.php');
require_once('generateassignments_form.php');
//require_once('$CFG->dirroot/local/onlinejudge/settings.php');

$id = optional_param('id', 0, PARAM_INT);  // Course Module ID
$a  = optional_param('a', 0, PARAM_INT);   // Assignment ID

$url = new moodle_url('/mod/assignment/type/onlinejudge/generateassignments.php');
if ($id) {
    if (! $cm = get_coursemodule_from_id('assignment', $id)) {
        print_error('invalidcoursemodule');
    }

    if (! $assignment = $DB->get_record("assignment", array("id"=>$cm->instance))) {
        print_error('invalidid', 'assignment');
    }

    if (! $course = $DB->get_record("course", array("id"=>$assignment->course))) {
        print_error('coursemisconf', 'assignment');
    }
    $url->param('id', $id);
} else {
    if (!$assignment = $DB->get_record("assignment", array("id"=>$a))) {
        print_error('invalidid', 'assignment');
    }
    if (! $course = $DB->get_record("course", array("id"=>$assignment->course))) {
        print_error('coursemisconf', 'assignment');
    }
    if (! $cm = get_coursemodule_from_instance("assignment", $assignment->id, $course->id)) {
        print_error('invalidcoursemodule');
    }
    $url->param('a', $a);
}


$PAGE->set_url($url);
require_login($course,true,$cm);
global $context;
$context = get_context_instance(CONTEXT_MODULE, $cm->id);
require_capability('mod/assignment:grade', $context);

//$testform = new generateassignments_form($DB->count_records('assignment_oj_testcases', array('assignment' => $assignment->id)));
$testform = new generateassignments_form();

if ($testform->is_cancelled()){

	redirect($CFG->wwwroot.'/mod/assignment/view.php?id='.$id);

} else if ($fromform = $testform->get_data()){
	$content = $testform->get_file_content('templatefile');
	$random = rand();
	$success = $testform->save_file('templatefile', $fullpath="/moodledata/test/file$random.Rnw", $override=false);
	$qtt=1;
	$rPath = get_config('local_onlinejudge', 'rpath');
	//$rPath = "/usr/bin/Rscript";
	$scriptPath = "$CFG->dirroot/local/onlinejudge/RScript.R";
	$templatePath = $fullpath;
	//$outputPath = "/var/www/Rnw/Rout/";
	$outputPath = get_config('local_onlinejudge', 'tmppath');
	//print_r($outputPath);
	$output_file_name = "name";	
	$command = "$rPath $scriptPath $qtt $templatePath $outputPath $output_file_name";
	exec($command,$output,$return);
	
	//print_r($return);
	//print_r($output);
	
	$html_path = $outputPath.$output_file_name."1.html";
	$html = file_get_contents($html_path);
	preg_match_all("/<h4>Question<\/h4>(.+)<h4>Solution<\/h4>/s", $html, $assignment_array);
	
	//print_r($output_array[1]);
	//Вытаскиваем текст задания
	$assignment_id = $DB->get_record("course_modules",array("id"=>$id));
	$assignment_id = $assignment_id->instance;
	$table="assignment";
	$updatedrecord->id=$assignment_id;
	$updatedrecord->intro=$assignment_array[1][0];
	$result=$DB->update_record($table, $updatedrecord);
	//print_r($updatedrecord);
	
	//Вытаскиваем и добавляем тестовые пары
	$testqtt=$fromform->testqtt;
	//На всякий случай
	if ($testqtt>10) $testqtt=10;
	
	preg_match_all("/<h4>Solution<\/h4>(.+)<br\/>/s", $html, $solution_array);
	$testpairs=$solution_array[1][0];
	$testpairs=strip_tags($testpairs);
	$split1 = preg_split('/delimiter/',$testpairs);
	$split2 = $split1[1];
	$split1 = $split1[0];
	$split1 = preg_split('/;/',$split1);
	$split2 = preg_split('/;/',$split2);
	//На этом этапе split1 содержит входные значения, split2 соответствующие выходные
	$cnt=0;
	// Get a number of records as an array of objects where all the given conditions met.
	//$currentcourseassignments=$DB->get_records("assignment_oj", array(), $sort='', $fields='*', $limitfrom=0, $limitnum=0);
	
	//Чистим существующие тесты
	$result = $DB->delete_records("assignment_oj_testcases", array('assignment'=>$assignment_id));
	for ($cnt=0;$cnt<$testqtt;$cnt++)
	{
		$testcase->assignment = $assignment_id;
		$testcase->input = $split1[$cnt];
		$testcase->output = $split2[$cnt];
		$testcase->usefile = false;
		$testcase->feedback = '';
		$testcase->subgrade = '';
		$testcase->id = $DB->insert_record('assignment_oj_testcases', $testcase);
	}
	
	redirect($CFG->wwwroot.'/mod/assignment/view.php?id='.$id);

} else {

    $assignmentinstance = new assignment_onlinejudge($cm->id, $assignment, $cm, $course);
    $assignmentinstance->view_header();

    $testcases = $DB->get_records('assignment_oj_testcases', array('assignment' => $assignment->id), 'sortorder ASC');

    $toform = array();
    if ($testcases) {
        $i = 0;
        foreach ($testcases as $tstObj => $tstValue) {
            $toform["input[$i]"] = $tstValue->input;
            $toform["output[$i]"] = $tstValue->output;
            $toform["feedback[$i]"] = $tstValue->feedback;
            $toform["subgrade[$i]"] = $tstValue->subgrade;
            $toform["usefile[$i]"] = $tstValue->usefile;
            $toform["caseid[$i]"] = $tstValue->id;

            file_prepare_draft_area($toform["inputfile[$i]"], $context->id, 'mod_assignment', 'onlinejudge_input', $tstValue->id, array('subdirs' => 0, 'maxfiles' => 1));
            file_prepare_draft_area($toform["outputfile[$i]"], $context->id, 'mod_assignment', 'onlinejudge_output', $tstValue->id, array('subdirs' => 0, 'maxfiles' => 1));

            $i++;
        }
    }

	$testform->set_data($toform);
	$testform->display();

	$assignmentinstance->view_footer();
}


//$assignment->course=$COURSE->id;
//$assignment->name='16-00';
//$assignment->intro='<p>16-00 description</p>';
//$assignment->introformat=1;
//$assignment->assignmenttype='onlinejudge';
//$assignment->resubmit=1;
//$assignment->preventlate=0;
//$assignment->emailteachers=0;
//$assignment->grade=100;
//$asignment->id = $DB->insert_record('assignment',$assignment);
//print_r($asignment->id);




