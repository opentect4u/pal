//Count Total no of EL leave for a perticular
//Calendar year
function fetch(trans_cd, fromDt, toDt, url){

    return $.ajax({
                type: "GET",
                data:{
                    
                    trans_cd: trans_cd,
                    fromDt: fromDt,
                    toDt:   toDt

                },
                url: url,
                async: false
            }).responseText;

}

//Datepicker Function
function datepicker(from_date, to_date, max_date){

    $('.buttonClass').daterangepicker({
            
        drops:          "down",
        buttonClasses:  "btn",
        applyClass:     "btn-info",
        cancelClass:    "btn-danger",
        startDate:      from_date,
        endDate:        to_date,
        maxDate:        max_date,
        locale: {

            format: 'DD/MM/YYYY'

        }

    });

}
