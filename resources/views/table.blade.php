<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title_table}}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="{{$table_id}}" class="table table-bordered table-striped">
                {!!$header!!}
                {!!$datas!!}
                {!!$footer!!}
            </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
<script>
$(function () {
    $("#{{$table_id}}").DataTable({
        "scrollX": true,
        "order": [[ {{ isset($col_order) ? $col_order : 1 }}, "{!!$table_order!!}" ]],
        "destroy": true,
        "lengthMenu": [5, 10, 20],
        "language": {
            "lengthMenu": "{{ltrans('globals.table_display')}} _MENU_ {{ltrans('globals.table_par_page')}}",
            "zeroRecords": "{{ltrans('globals.table_not_found')}}",
            "info": "{{ltrans('globals.table_display')}} _PAGE_ {{ltrans('globals.table_de')}}  _PAGES_",
            "infoEmpty": "{{ltrans('globals.table_not_found')}}",
            "infoFiltered": "({{ltrans('globals.table_filtered')}} _MAX_ {{ltrans('globals.table_enregistrements')}})"
        }
      });
});
 </script>
