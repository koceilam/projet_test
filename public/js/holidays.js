/**
 * [Manage  holidays dates]
 * @param
 * @return {[type]}     [description]
 */
$(document).ready(function(){
    $(function () {

        $('#dates_holiday').daterangepicker(
            {
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " / ",
                "applyLabel": "Appliquer",
                "cancelLabel": "Annuler",
                "fromLabel": "Du",
                "toLabel": "Au",
                "customRangeLabel": "Personnaliser",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sa"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "September",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            timePicker: true,
            timePickerIncrement: 1,
            timePickerSeconds: true,
            format: 'YYYY-MM-DD HH:mm:ss'
            }
        );

        $('#dates_holiday').on('apply.daterangepicker', function(ev, picker) {
            /*if (checkDate( picker.startDate.format('YYYY-MM-DD HH:mm:ss'),
                picker.endDate.format('YYYY-MM-DD HH:mm:ss'),
                $('#check').text(),
                ''
            )) {
            } else {
               // $('#dates_holiday').val("");
            }*/
        });



    });

     $("#adding").submit(function(){
        $("#post").html('');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            data: new FormData(this),
            url: this.action,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status == "ok") {
                    if ($("#retour" ).length == 0) {
                        location.href = '/';
                    } else {
                        location.href = $("#retour").text();
                    }
                } else {
                    bootbox.alert( data.status + " " + data.message[0]  );
                }
            },
             error: function(response,status_resp, errorThrown ){
                var json = JSON.parse (response.responseText);
                $.each(json, function(index, value) {
                      $.each(value, function( index, valeur ) {
                        $("#post").append(valeur + "<br />");
                        });
                });
            }
        });
        return false;
    });
});



/**
 * [approveHoliday : Approve or refuse holiday]
 * @param  {[type]} url_approve [description]
 * @return {[type]}             [description]
 */
approveHoliday = function(url_approve){
    var message = { statut:'ko'};
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url: url_approve,
        async: false,
        success: function(data){
            if (data.status == "ok") {
                message = { statut: "ok", message: "élément mis à jour"};
            } else {
                message = { statut:"ko", message :data.message  };
            }
            return message;
        },
        error: function(response,status_resp, errorThrown ){
            message = { statut:"ko", message :"page inaccessible"  };
            return message;
        }
    });
    return message;
};

$(document).on("click", ".approve", function(event) {
    event.preventDefault();
    var rang = this;
    var $killrow = $(this.parentNode.parentNode);
    bootbox.confirm(  "Êtes-vous sûr ?"   , function(result) {
        if (result) {
            var retour = approveHoliday( rang.href );
            if (retour.statut == 'ok' ) {
                $killrow.fadeOut(2000, function(){
                    this.remove();
                });
            } else {
                bootbox.alert(retour.message);
            }
        }
    });
});
