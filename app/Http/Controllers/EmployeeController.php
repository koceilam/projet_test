<?php

namespace App\Http\Controllers;
use Log;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class EmployeeController extends BaseController {
  /**
   * [index :  Homepage Welcome]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function index(Request $request,$id) {

        $object = new Employee();
        $data_employee = $object->getEmployeeInfo($id);
        $user_name = (isset($data_employee[0]->name)? $data_employee[0]->name: '');
        $profile = (isset($data_employee[0]->profile)? $data_employee[0]->profile: '');
        $content_view = $object->getViewEmployee($id,$profile);
        $footer = view('tablefooter');
        $url_add = url() . "/user/".$id."/add_holiday";
        $header_detail = '<a href="'.$url_add.'" class="btn btn-block btn-primary">'.ltrans('holidays.add').'</a>';

        return view('home', [
                             'user_name' => $user_name .'( '.$profile.' )',
                             'content_header'        => ltrans('globals.headerTitle'),
                             'content_header_detail' => $header_detail,
                             'content'                  => $content_view ,
                             'footer'                   => $footer
                             ]);
  }

  /**
   * [getListHolidayApproved :Get the list of all employees holidays approved by the admin ]
   * @param  [type] $id_admin    [description]
   * @param  [type] $employee_id [description]
   * @return [type]              [description]
   */
  public function getListHolidayApproved($id_admin,$employee_id) {

        $object = new Employee();
        $data_admin = $object->getEmployeeInfo($id_admin);
        $data_employee = $object->getEmployeeInfo($employee_id);
        $admin_name = (isset($data_admin[0]->name)? $data_admin[0]->name: '');
        $admin_profile = (isset($data_admin[0]->profile)? $data_admin[0]->profile: '');
        $user_name = (isset($data_employee[0]->name)? $data_employee[0]->name: '');
        $content_view = $object->getViewHolidayApproved($employee_id);
        $footer = view('tablefooter');
        $url_add = url() ."/user/".$id_admin."/add_holiday";
        $header_detail = '<a href="'.$url_add.'" class="btn btn-block btn-primary">'.ltrans('holidays.add').'</a>';

        return view('home', [
                             'user_name' => $admin_name .'( '.$admin_profile.' )',
                             'content_header'        => ltrans('globals.headerTitle'),
                             'content_header_detail' => $header_detail,
                             'content'                  => $content_view ,
                             'footer'                   => $footer
                             ]);
  }

  /**
   * [addHoliday : Create a new holday for the current connected user]
   * @param Request $request [description]
   * @param [type]  $id      [description]
   */
  public function addHoliday(Request $request,$id) {

        $object = new Employee();
        $data_employee = $object->getEmployeeInfo($id);
        $user_name = (isset($data_employee[0]->name)? $data_employee[0]->name: '');
        $profile = (isset($data_employee[0]->profile)? $data_employee[0]->profile: '');
        $content_view = $object->getViewEmployee($id,$profile);
        $header_detail = '';
        $form = $object->buildFormHolyday('create','/user/'.$id.'/createByAjax',[],$id);
        $footer = view('tablefooter');
        return view('home', [
                             'user_name'              => $user_name .'( '.$profile.' )',
                             'content_header'         => ltrans('holidays.addHoliday'),
                             'content_header_detail'  => $header_detail,
                             'content'                => $form,
                             'footer'                 => $footer
                             ]);
  }


   /**
    * [createByAjax : Save by Ajax the data of the new holiday ]
    * @param  Request $request [description]
    * @param  [type]  $id      [description]
    * @return [type]           [description]
    */
    public function createByAjax (Request $request,$id) {
        if ($request->has('dates_holiday') ) {
            $dates =$request->input('dates_holiday');
            $object = new Employee();
            $msg = '';
            $comment = $request->input('comment');
            if ( $object->SetHolidayEmployee( $id,$dates,$comment) ) {
                return response()->json( [ 'status' => 'ok',  'message' => [ 'succes' ] ],200);
            } else {
                return response()->json( [ 'status' => 'ko',  'message' => [ 'erreur' . " $msg" ] ],200);
            }
        } else {
            return response()->json( [ 'status' => 'ko',  'message' => ['manquant' ] ],200);
        }

    }

/**
 * [editHoliday : Modify a holday for the current connected user]
 * @param  Request $request    [description]
 * @param  [type]  $id         [description]
 * @param  [type]  $holiday_id [description]
 * @return [type]              [description]
 */
  public function editHoliday(Request $request,$id,$holiday_id) {

        $object = new Employee();
        $data_employee = $object->getEmployeeInfo($id);
        $user_name = (isset($data_employee[0]->name)? $data_employee[0]->name: '');
        $profile = (isset($data_employee[0]->profile)? $data_employee[0]->profile: '');
        $content_view = $object->getViewEmployee($id,$profile);
        $header_detail = '';
        $form = $object->buildFormHolyday('update','/user/'.$id.'/updateByAjax/'.$holiday_id,[],$id,$holiday_id);
        $footer = view('tablefooter');
        return view('home', [
                             'user_name'              => $user_name .'( '.$profile.' )',
                             'content_header'         => ltrans('holidays.editHoliday'),
                             'content_header_detail'  => $header_detail,
                             'content'                => $form,
                             'footer'                 => $footer
                             ]);
  }

  /**
   * [updateByAjax : Save by Ajax the holiday's data modified by the current user ]
   * @param  Request $request    [description]
   * @param  [type]  $id         [description]
   * @param  [type]  $holiday_id [description]
   * @return [type]              [description]
   */
  public function updateByAjax (Request $request,$id,$holiday_id) {
        if ($request->has('dates_holiday') ) {
            $dates =$request->input('dates_holiday');
            $object = new Employee();
            $msg = '';
            $comment = $request->input('comment');
            if ( $object->updateHolidayEmployee( $holiday_id,$dates,$comment) ) {
                return response()->json( [ 'status' => 'ok',  'message' => [ 'succes' ] ],200);
            } else {
                return response()->json( [ 'status' => 'ko',  'message' => [ 'erreur' . " $msg" ] ],200);
            }
        } else {
            return response()->json( [ 'status' => 'ko',  'message' => ['manquant' ] ],200);
        }

    }

  /**
   * [updateHolidayStatus : Change by Ajax the  holiday satus To (Approve or Refuse ) ]
   * @param  [type] $id         [description]
   * @param  [type] $holiday_id [description]
   * @param  [type] $status     [description]
   * @return [type]             [description]
   */
  public function updateHolidayStatus( $id,$holiday_id,$status) {

        try {
            $object = new Employee();
            $msg = '';
            if( $object->updateStatusHoliday( $holiday_id,$status)) {
                    return response()->json( [ 'status' => 'ok',  'message' => [ 'succes' ] ],200);
                } else {
                    return response()->json( [ 'status' => 'ko',  'message' => [ 'erreur' ] ],200);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json( [ 'status' => 'ko',  'message' => [ 'erreur' ] ],200);
        }
    }
}
