<?php

namespace App\Models;

use Log;
use DB;
use App\Http\Controllers\Common;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $textes_file = 'holidays';

    protected $primaryKey = 'id';
    protected $table_id = "employee_id";
    protected $fields = array(
                    'id'            => 'id',
                    'date_begin'    => 'date_begin',
                    'date_end'      => 'date_end',
                    'status'        => 'status',
                    'date_c'        => 'date_c',
                    'actions'       => 'actions',
                );
    protected $fields_employee = array(
                    'id'            => 'id',
                    'name'          => 'name',
                    'profile'       => 'profile',
                    'date_c'        => 'date_c',
                );

    protected $holidays_status = array(
                                '0' => 'demande en attente',
                                '1' => 'congé approuvé',
                                '2' => 'congé refusé',
                            );
    /**************************************************************************
    * Methodes names describe what they do . so we don't need explain more.   *
    *                                                                         *
    * *************************************************************************/

    /**
     * [getListHolidaysEmployee description]
     * @param  [type] $employee_id [description]
     * @return [type]              [description]
     */
    public function getListHolidaysEmployee ($employee_id) {
          $sResult = DB::select("SELECT id, employee_id, date_begin, date_end, status, comment, date_c
                                    FROM holidays
                                    WHERE employee_id =?"
                                ,[$employee_id]);
          return $sResult;
    }

    /**
     * [getHolidaysEmployee description]
     * @param  [type] $employee_id [description]
     * @param  [type] $holiday_id  [description]
     * @return [type]              [description]
     */
    public function getHolidaysEmployee ($employee_id,$holiday_id) {
              $sResult = DB::select("SELECT id, employee_id, date_begin, date_end, status, comment, date_c
                                        FROM holidays
                                        WHERE employee_id =? AND id=?"
                                    ,[$employee_id,$holiday_id]);
              return $sResult;
        }

    /**
     * [getListHolidaysWaitting description]
     * @return [type] [description]
     */
    public function getListHolidaysWaitting () {
            $sResult = DB::select("SELECT id, employee_id, date_begin, date_end, status, comment, date_c
                                      FROM holidays
                                      WHERE status =0");
            return $sResult;
    }

    /**
     * [getListHolidayApproved description]
     * @param  [type] $employee_id [description]
     * @return [type]              [description]
     */
    public function getListHolidayApproved ($employee_id) {
            $sResult = DB::select("SELECT id, employee_id, (SELECT E.name FROM employees AS E WHERE E.id = employee_id) as name_employee,
                                          date_begin, date_end, status, comment, date_c
                                      FROM holidays
                                      WHERE status = 1 AND  employee_id = ?"
                                  ,[$employee_id]);
            return $sResult;
    }

    /**
     * [getListListEmployees description]
     * @return [type] [description]
     */
    public function getListListEmployees () {
            $sResult = DB::select("SELECT id, name, status, (CASE status WHEN  1 THEN 'Admin' ELSE 'Pas admin' END) AS profile , date_c FROM employees");
            return $sResult;
    }

    /**
     * [getEmployeeInfo description]
     * @param  [type] $employee_id [description]
     * @return [type]              [description]
     */
    public function getEmployeeInfo ($employee_id) {

            $sResult = DB::select("SELECT id, name, status, (CASE status WHEN  1 THEN 'Admin' ELSE 'Pas admin' END) AS profile , date_c
                                      FROM employees
                                      WHERE id =?"
                                  ,[$employee_id]);

            return $sResult;
    }

    /**
     * [SetHolidayEmployee description]
     * @param [type] $employee_id [description]
     * @param [type] $dates       [description]
     * @param [type] $comment     [description]
     */
    public function SetHolidayEmployee ($employee_id,$dates,$comment) {
            $adates = explode(' - ', $dates);
            $sResult = DB::insert(" INSERT INTO holidays (employee_id, date_begin, date_end, comment)
                                          VALUES(?,?,?,?) "
                                              ,[$employee_id, $adates[0], $adates[1], $comment]);

            return $sResult;
    }

    /**
     * [updateHolidayEmployee description]
     * @param  [type] $id      [description]
     * @param  [type] $dates   [description]
     * @param  [type] $comment [description]
     * @return [type]          [description]
     */
    public function updateHolidayEmployee ($id,$dates,$comment) {
            $adates = explode(' - ', $dates);
            $sResult = DB::insert(" UPDATE holidays
                                       SET date_begin = ?, date_end = ?, comment =?
                                       WHERE $id = ?"
                                              ,[$adates[0], $adates[1], $comment, $id]);

          return $sResult;
    }


    /**
     * [updateStatusHoliday description]
     * @param  [type] $holiday_id [description]
     * @param  [type] $status     [description]
     * @return [type]             [description]
     */
    public function updateStatusHoliday ($holiday_id,$status) {
            if( in_array($status, array(1,2))){
                $sResult = DB::insert(" UPDATE holidays
                                           SET status = ?
                                           WHERE id = ?"
                                          ,[$status,$holiday_id]);
                return $sResult;
            }else{
              return false;
            }
    }

    /**
     * [getViewEmployee description]
     * @param  [type] $employee_id [description]
     * @param  string $status      [description]
     * @return [type]              [description]
     */
    public function getViewEmployee ($employee_id,$status='Admin') {
        $sResult = $this->getListHolidaysEmployee($employee_id);

        $header = Common::buildTableFrames('thead', $this->fields,$this->textes_file);
        $footer = Common::buildTableFrames('tfoot', $this->fields, $this->textes_file);
        $datas = '<tbody>';
        foreach ( $sResult as $item ) {
            $datas .= '<tr>';
            foreach ( $this->fields as $key => $value ) {
                if ( $key == 'actions'  ) {
                    $url_edit = Common::buildBouton( url() . "/user/".$employee_id."/edit_holiday/" . $item->id ,'fa fa-edit btn-xs btn-success',$this->textes_file,"edition");
                    $datas .= '<td>' . $url_edit  ."</td>\n";
                } else {
                  if($key == 'status'){
                      $datas .= '<td>' .$this->holidays_status[$item->$value] ."</td>\n";
                    }else{
                    $datas .= '<td>' . $item->$value ."</td>\n";
                    }
                }
            }
            $datas .= '</tr>';
        }
        $datas .= '</tbody>';

        $view_Holiday_current = view('table',[
                                              'title_table' => ltrans($this->textes_file.'.my_list_holidays'),
                                              'table_id' => $this->table_id,
                                              'header' => $header,
                                              'footer' => $footer,
                                              'datas' => $datas,
                                              'table_order'   => 'asc',
                                              ]);
      if($status !='Admin'){
        return $view_Holiday_current;
      }else{
        $view_Holiday_waitting = $this->getViewHolidaysWaitting($employee_id);
        $view_All_employees= $this->getViewAllEmployees($employee_id);
        return $view_Holiday_current.$view_Holiday_waitting.$view_All_employees;
      }


    }


    /**
     * [getViewHolidaysWaitting description]
     * @param  integer $employee_id [description]
     * @return [type]               [description]
     */
    public function getViewHolidaysWaitting ($employee_id =1) {

        $sResult = $this->getListHolidaysWaitting();
        $header = Common::buildTableFrames('thead', $this->fields,$this->textes_file);
        $footer = Common::buildTableFrames('tfoot', $this->fields, $this->textes_file);
        $datas = '<tbody>';
        foreach ( $sResult as $item ) {
            $datas .= '<tr>';
            foreach ( $this->fields as $key => $value ) {
                if ( $key == 'actions'  ) {
                    $url_approve= Common::buildBouton(  url() . "/user/".$employee_id."/updateHolidayStatus/" . $item->id.'/1','glyphicon glyphicon-ok btn-xs btn-success','Approuver','approve');
                    $url_refuse= Common::buildBouton(  url() . "/user/".$employee_id."/updateHolidayStatus/" . $item->id.'/2','fa fa-close btn-xs btn-danger', 'Refuser','approve');
                    $datas .= '<td>' . $url_approve  .$url_refuse ."</td>\n";
                } else {
                  if($key == 'status'){
                      $datas .= '<td>' .$this->holidays_status[$item->$value] ."</td>\n";
                    }else{
                    $datas .= '<td>' . $item->$value ."</td>\n";
                    }
                }
            }
            $datas .= '</tr>';
        }
        $datas .= '</tbody>';
        return view('table',[
                                'title_table' => ltrans($this->textes_file.'.list_holidays_waitting'),
                                'table_id' =>'wait_'.$this->table_id,
                                'header' => $header,
                                'footer' => $footer,
                                'datas' => $datas,
                                'table_order'   => 'asc',
                                ]);
    }

    /**
     * [getViewAllEmployees description]
     * @param  [type] $id_admin [description]
     * @return [type]           [description]
     */
    public function getViewAllEmployees ($id_admin) {

        $sResult = $this->getListListEmployees();
        $header = Common::buildTableFrames('thead', $this->fields_employee,$this->textes_file);
        $footer = Common::buildTableFrames('tfoot', $this->fields_employee, $this->textes_file);
        $datas = '<tbody>';
        foreach ( $sResult as $item ) {
            $datas .= '<tr>';
            foreach ( $this->fields_employee as $key => $value ) {
                if ( $key == 'name'  ) {
                    $url= url() . "/user/$id_admin/holidays/".$item->id;
                    $datas .= '<td><a href="'.$url.'" >' . $item->$value  . "</a></td>\n";
                } else {
                    $datas .= '<td>' . $item->$value ."</td>\n";
                }
            }
            $datas .= '</tr>';
        }
        $datas .= '</tbody>';
        return view('table',[
                                'title_table' => ltrans($this->textes_file.".list_employees"),
                                'table_id' =>'list_employees_'.$this->table_id,
                                'header' => $header,
                                'footer' => $footer,
                                'datas' => $datas,
                                'table_order'   => 'asc',
                                ]);
    }

    /**
     * [getViewHolidayApproved description]
     * @param  [type] $employee_id [description]
     * @return [type]              [description]
     */
    public function getViewHolidayApproved ($employee_id) {

        $sResult = $this->getListHolidayApproved($employee_id);
        unset($this->fields['actions']);
        $header = Common::buildTableFrames('thead', $this->fields,$this->textes_file);
        $footer = Common::buildTableFrames('tfoot', $this->fields, $this->textes_file);
        $datas = '<tbody>';
        $name_employee = '';
        foreach ( $sResult as $item ) {
         $name_employee = $item->name_employee;
            $datas .= '<tr>';
            foreach ( $this->fields as $key => $value ) {
                if($key == 'status'){
                      $datas .= '<td>' .$this->holidays_status[$item->$value] ."</td>\n";
                    }else{
                    $datas .= '<td>' . $item->$value ."</td>\n";
                    }
            }
            $datas .= '</tr>';
        }
        $datas .= '</tbody>';
        return view('table',[
                                'title_table' => ltrans( $this->textes_file.'.list_holidays_approve'). $name_employee,
                                'table_id' =>'list_employees_'.$this->table_id,
                                'header' => $header,
                                'footer' => $footer,
                                'datas' => $datas,
                                'table_order'   => 'asc',
                                ]);
    }

    /**
     * [buildFormHolyday description]
     * @param  string $action      [description]
     * @param  [type] $action_path [description]
     * @param  [type] $datas       [description]
     * @param  [type] $employee_id [description]
     * @param  [type] $holiday_id  [description]
     * @return [type]              [description]
     */
   public function buildFormHolyday ( $action = "create", $action_path, $datas = null, $employee_id = null, $holiday_id =null) {
      $data_holoday = $this->getHolidaysEmployee ($employee_id,$holiday_id);
      if(isset($data_holoday[0])){
        $data = $data_holoday[0];
        $date_begin= $data->date_begin;
        $date_end= $data->date_end;
        $comment= $data->comment;
      }else{
       $date_begin = $date_end = $comment =null;
      }
      return view('holidays_form', [
                                  'date_begin'               => $date_begin,
                                  'date_end'               => $date_end,
                                  'comment'               =>$comment,
                                  'post_action'       =>  $action_path,
                                  'retour'            => '/user/'.$employee_id,
                                  ]);
  }

}

