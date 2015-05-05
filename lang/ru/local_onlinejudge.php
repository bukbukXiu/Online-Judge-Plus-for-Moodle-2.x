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
 * Strings for local_onlinejudge
 * 
 * @package   local_onlinejudge
 * @copyright 2011 Sun Zhigang (http://sunner.cn)
 * @author    Sun Zhigang
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['about'] = 'О модуле';
$string['aboutcontent'] = '<a href="https://github.com/hit-moodle/moodle-local_onlinejudge">Online Judge</a> is developed by <a href="http://www.hit.edu.cn">Harbin Institute of Technology</a>, and licensed by <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a>.';
$string['badvalue'] = 'Недопустимое значение';
$string['cannotrunsand'] = 'Can not run the sand';
$string['compileroutput'] = 'Сообщения компилятора';
$string['cpuusage'] = 'Использование ЦП';
$string['defaultlanguage'] = 'Язык по-умолчанию';
$string['defaultlanguage_help'] = 'Язык по-умолчанию для новых заданий типа Online Judge';
$string['details'] = 'Подробности';
$string['ideoneautherror'] = 'Неправильное имя пользователя или пароль';
$string['ideonedelay'] = 'Интервал между запросами к ideone.com (в секундах)';
$string['ideonedelay_help'] = 'Если интервал между отправкой judge-запроса и получением результата слишком мал, ideone.com не обработает запрос.';
$string['ideoneerror'] = 'Ideone вернул ошибку: {$a}';
$string['ideonelogo'] = '<a href="https://github.com/hit-moodle/moodle-local_onlinejudge">Moodle Online Judge</a> uses <a href="http://ideone.com">Ideone API</a> &copy; by <a href="http://sphere-research.com">Sphere Research Labs</a>';
$string['ideoneresultlink'] = 'See details at <a href="http://ideone.com/{$a}">http://ideone.com/{$a}</a>.';
$string['ideoneuserrequired'] = 'Необходимо, если ideone.com выбран в качестве judge';
$string['info'] = 'Информация';
$string['info0'] = 'Если вы ждете слишком долго, сообщите администратору';
$string['info1'] = 'Поздравляем!!!';
$string['info2'] = 'Хорошая программа должна возвращать 0, если не возникло ошибок';
$string['info3'] = 'Компилятору не нравится ваш код';
$string['info4'] = 'Похоже, компилятору нравится ваш код';
$string['info5'] = 'Вы превысили лимит доступной памяти';
$string['info6'] = 'В вашем коде слишком много stdout';
$string['info7'] = 'Почти идеально, проверьте наличие лишних пробелов, табуляцию, new line...';
$string['info8'] = 'В вашем коде содержится ряд функций,  <em>запрещенных</em> к использованию';
$string['info9'] = '[SIGSEGV, Segment fault] Неправильный индекс массива, неправильный указатель или что-то похуже ';
$string['info10'] = 'Программа выполнялась слишком долго';
$string['info11'] = 'Еще раз проверьте ваш код. Возможно наличие опечаток или недопустимых символов.';
$string['info21'] = 'Judge работает неправильно. Пожалуйста, сообщите администратору';
$string['info22'] = 'Если вы ждете слишком долго, сообщите администратору';
$string['infostudent'] = 'Информация';
$string['infoteacher'] = 'Sensitive information';
$string['invalidlanguage'] = 'Неправильный ID языка: {$a}';
$string['invalidjudgeclass'] = 'Invalid judge class: {$a}';
$string['invalidtaskid'] = 'Неправильный id задания: {$a}';
$string['judgedcrashnotify'] = 'Уведомление в случае неисправности Judge-демона';
$string['judgedcrashnotify_help'] = 'Judge-демон может перестать работать из-за программных ошибок или апгрейда. Если это произойдет, кто должен получить уведомление? Это должен быть пользователь с правом доступа к серверу для запуска judge-демона.';
$string['judgednotifybody'] = 'Среди {$a->count} заданий, находящихся в обработке, крайнее в очереди задание находится в очереди {$a->period}.

Возможно, Judge-демон не работает. Необходимо запустить его как можно скорее!

Возможно, в очереди на проверку слишком много заданий. Попробуйте запустить несколько Judge-демонов.';
$string['judgednotifysubject'] = '{$a->count} заданий находятся в очереди слишком долго';
$string['judgestatus'] = 'Online Judge Plus проверил <strong>{$a->judged}</strong> заданий и <strong>{$a->pending}</strong> заданий в очереди на проверку.';
$string['langc_sandbox'] = 'C (запускать локально)';
$string['langc_warn2err_sandbox'] = 'C (запускать локально, предупреждения как ошибки)';
$string['langcpp_sandbox'] = 'C++ (запускать локально)';
$string['langcpp_warn2err_sandbox'] = 'C++ (запускать локально, предупреждения как ошибки)';
$string['maxcpulimit'] = 'Максимальное время использования процесора (секунды)';
$string['maxcpulimit_help'] = 'Как долго проверяемая программа может выполняться.';
$string['maxmemlimit'] = 'Лимит памяти (MB)';
$string['maxmemlimit_help'] = 'Как много памяти может использовать проверяемая программа.';
$string['memusage'] = 'Использование памяти';
$string['messageprovider:judgedcrashed'] = 'Уведомление в случае неисправности Judge-демона';
$string['mystat'] = 'Моя статистика';
$string['notesensitive'] = '* Доступно только преподавателю';
$string['onefileonlyideone'] = 'Ideone.com не поддерживает отправку нескольких файлов';
$string['onlinejudge:viewjudgestatus'] = 'Показать статус Judge';
$string['onlinejudge:viewmystat'] = 'Показать вашу статистику';
$string['onlinejudge:viewsensitive'] = 'View sensitive details';
$string['pluginname'] = 'Online Judge Plus';
$string['sandboxerror'] = 'Ошибка Sandbox: {$a}';
$string['settingsform'] = 'Настройки Online Judge Plus';
$string['settingsupdated'] = 'Настройки обновлены.';
$string['status0'] = 'В обрадотке...';
$string['status1'] = 'Принято';
$string['status2'] = 'Abnormal Termination';
$string['status3'] = 'Ошибка компиляции';
$string['status4'] = 'Успешная компиляция';
$string['status5'] = 'Превышен лимит памяти';
$string['status6'] = 'Output-Limit Exceed';
$string['status7'] = 'Presentation Error';
$string['status9'] = 'Ошибка Выполнения';
$string['status8'] = 'Запрещенные функции';
$string['status10'] = 'Превышен лимит времени выполнения';
$string['status11'] = 'Неправильный ответ';
$string['status21'] = 'Внутренняя ошибка';
$string['status22'] = 'Проверка...';
$string['status23'] = 'Multi-status';
$string['status255'] = 'Unsubmitted';
$string['stderr'] = 'Standard error output';
$string['stdout'] = 'Standard output';
$string['upgradenotify'] = 'Do NOT forget to execute cli/install_assignment_type and cli/judged.php. Details in <a href="https://github.com/hit-moodle/moodle-local_onlinejudge/blob/master/README.md" target="_blank">README</a>.';
$string['rpath'] = 'Путь к Rscript';
$string['rpath_help'] = 'Путь к исполняемому файлу Rscript на вашем сервере';
$string['tmppath'] = 'Путь к темп-директории';
$string['tmppath_help'] = 'Сервер должен иметь права на запись в директорию';
