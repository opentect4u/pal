//For Getting Param value from md_parameters
function getParamVal(id){

    return $.ajax({
        type: "GET",
        data:{

            id: id

        },
        url: window.location.protocol+"//"+window.location.hostname+'/pal/auths/param',
        async: false
    }).responseText;

}

//Minimmum Leave date
class ValidDates{
    
    constructor(from_date, to_date){

        this.date1   =   new Date(from_date);

        this.date2   =   new Date(to_date);

    }
    
    //El subission lower bound
    validEl(){

        if((Math.round((this.date2 - this.date1)/(1000*60*60*24)) + 1) < parseInt(getParamVal(6))){

            return false;

        }
        else{
    
            return true;
    
        }

    }

    //Date Range
    dateRange(){
        
        var timeDiff = Math.abs(this.date2.getTime() - this.date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        
        return (diffDays + 1);
    }

}

//Count Total no of EL leave for a perticular
//Calendar year
function fetch(fromDt, toDt, url){

    return $.ajax({
                type: "GET",
                data:{

                    fromDt: fromDt,
                    toDt:   toDt

                },
                url: url,
                async: false
            }).responseText;

}

//Datepicker Function
function datepicker(from_date, to_date, min_date){

    $('.buttonClass').daterangepicker({
            
        drops:          "down",
        buttonClasses:  "btn",
        applyClass:     "btn-info",
        cancelClass:    "btn-danger",
        startDate:      from_date,
        endDate:        to_date,
        minDate:        min_date,
        locale: {

            format: 'DD/MM/YYYY'

        }

    });

}
