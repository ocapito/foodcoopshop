<?php

namespace App\Model\Table;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\I18n\I18n;

/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 2.3.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
class CronjobsTable extends AppTable
{
    
    public $cronjobRunDay;
    
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('CronjobLogs', [
            'foreignKey' => 'cronjob_id'
        ]);
    }
    
    public function run()
    {
        
        if (empty($this->cronjobRunDay)) {
            $this->cronjobRunDay = time();
        }
        
        $cronjobs = $this->find('all', [
            'conditions' => [
                'Cronjobs.active' => APP_ON
            ]
        ])->all();
        
        $tmpLocale = I18n::getLocale();
        I18n::setLocale('en_US');
        $currentWeekday = Configure::read('app.timeHelper')->getWeekdayName(date('w', $this->cronjobRunDay));
        I18n::setLocale($tmpLocale);
        
        $currentDayOfMonth = date('w', $this->cronjobRunDay);
        
        $executedCronjobs = [];
        
        foreach($cronjobs as $cronjob) {
            
            $shouldCronjobBeExecutedByTimeInterval = false;
            
            switch($cronjob->time_interval) {
                case 'day':
                    $timeCondition = '1 day';
                    $shouldCronjobBeExecutedByTimeInterval = true;
                    break;
                case 'week':
                    $cronjobWeekdayIsCurrentWeekday = $cronjob->weekday == $currentWeekday;
                    $timeCondition = '1 week';
                    if ($cronjobWeekdayIsCurrentWeekday) {
                        $shouldCronjobBeExecutedByTimeInterval = true;
                    }
                    break;
                case 'month':
                    $cronjobDayOfMonthIsCurrentDayOfMonth = $cronjob->day_of_month == $currentDayOfMonth;
                    $timeCondition = '1 month';
                    if ($cronjobDayOfMonthIsCurrentDayOfMonth) {
                        $shouldCronjobBeExecutedByTimeInterval = true;
                    }
                    break;
            }
            
            if (!$shouldCronjobBeExecutedByTimeInterval) {
                continue;
            }
                
            $executeCronjob = false;
            
            $cronjobLogs = $this->CronjobLogs->find('all', [
                'conditions' => [
                    'CronjobLogs.cronjob_id' => $cronjob->id
                ],
                'order' => [
                    'CronjobLogs.created' => 'DESC'
                ]
            ])->first();
            
            if (empty($cronjobLogs) || $cronjobLogs->success == APP_OFF) {
                $executeCronjob = true;
            }
            
//             if ($cronjob_log->created->wasWithinLast($timeCondition) === true) {
//                 $executeCronjob = false;
//                 break;
//             }

            if ($executeCronjob) {
                
                $shell = new Shell();
                $success = $shell->dispatchShell('BackupDatabase');
                $success = $success === 0 ? 1 : 0;
                
                $executedCronjobs[] = [
                    'name' => $cronjob->name,
                    'success' => $success
                ];
                
                $entity = $this->CronjobLogs->newEntity(
                    [
                        'cronjob_id' => $cronjob->id,
                        'success' => $success
                    ]
                );
                $this->CronjobLogs->save($entity);
            }
                
        }
        
        return $executedCronjobs;
        
    }
    
}
