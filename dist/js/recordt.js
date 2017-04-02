/**
 * Created by yangwei on 10/4/15.
 */
$(function () {

    //Initialize Select2 Elements
    $(".select2").select2({
        minimumResultsForSearch: Infinity
    });

    //time picker initialize
    $(".timepicker").timepicker({
        showInputs: false
    });

    //Datemask dd/mm/yyyy
    $('.datepicker').datepicker();

    $('.datepicker').on('changeDate',function(){
        $('.datepicker').datepicker('show');
        $('.datepicker').datepicker('hide');
    });
});