                <form role="form" class="form-horizontal" action="{{$post_action}}" method="POST" id="adding">
                <div class="box-body">
                    <div class="hide" id="post">{{$post_action}}</div>
                    <div class="hide" id="retour">{{$retour}}</div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >
                            {{ltrans('holidays.dates')}}
                        </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{ isset($date_begin) ? $date_begin.' - '.$date_end : ''}}" name="dates_holiday" id="dates_holiday" readonly>
                            </div><!-- /.input group -->
                        </div>
                    </div>
                    <div id="elements">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="holidays_text">{{ltrans('holidays.holidays_text')}}</label>
                        <div class="col-sm-10">
                            <textarea rows="4" cols="64" id="holidays_text" name="comment" maxlength="165">{{ isset($comment) ? $comment: ''}}</textarea>
                        </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ltrans('globals.submit')}}</button>
                  </div>
                </form>
