// $(document).ready(function(){
//     // alert("A");
//     $.ajax({
//         type:"get",
//         url:getAlertedProvJson,
//         data:{
//             _token: csrf
//         },
//         success:function(res){
//             // alert(res.length);
//             var res = jQuery.parseJSON(res);
//             console.log(res);
//             $.each(res, function(i, item) {
//                 if(parseFloat(item.popCount) == 0){
//                   var day=11;
//                 }
//                 var day = parseFloat(item.reserveKcal) / (parseFloat(item.popCount) * parseFloat(item.Kcal));
//                 $('path[name="' + item.provEngName + '"]').attr('danger', '1');
//                 if(day < 30){
//                     $('path[name="' + item.provEngName + '"]').removeClass('aimag');
//                     $('path[name="' + item.provEngName + '"]').addClass('aimag1');
//                 }
//             });
//         }
//     });
// });



$(document).on("click", '#btnDeclareDangerModal', function(event) {
        if($("#cmbDangerType").val() == "-1"){
            alertify.error("Дайчилгаа зарлах төрлөө зарлана уу!!!");
            $("#frmDeclareDangerByBus #txtPassword").removeClass('border border-danger');
            return;
        }
        $('#frmDeclareDangerByBus')[0].reset();
        $('#frmDeclareDangerByProvince')[0].reset();
        $('#frmDeclareDangerBySum')[0].reset();

        $('#modalDeclareDanger form').hide();
        if($("#cmbDangerType").val() == "1"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerByBus").show();
            return;
        }
        if($("#cmbDangerType").val() == "2"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerByProvince").show();
            $("#frmDeclareDangerByProvince #cmbBus").removeClass('border border-danger');
            $("#frmDeclareDangerByProvince #txtPassword").removeClass('border border-danger');
            return;
        }
        if($("#cmbDangerType").val() == "3"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerBySum #hide").show();
            $("#frmDeclareDangerBySum").show();
            $("#frmDeclareDangerBySum #cmbBus").removeClass('border border-danger');
            $("#frmDeclareDangerBySum #cmbProvs").removeClass('border border-danger');
            $("#frmDeclareDangerBySum #txtPassword").removeClass('border border-danger');
            return;
        }
});

$(document).ready(function(){
    $("#frmDeclareDangerByProvince #cmbBus").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                bus:$(this).val()
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                var div="";
                $.each(table, function(index, item){
                    div = div + '<div class="col-md-4">';
                    div = div + '<div class="form-check">';
                    div = div + '<label class="form-check-label">';
                    div = div + '<input type="checkbox" class="form-check-input provs" name="provs[]" value="' + item.id + '">' + item.provName;
                    div = div + '</label></div></div>';
                });
                $("#frmDeclareDangerByProvince #divProvs").html('');
                $("#frmDeclareDangerByProvince #divProvs").html(div);
            }
        });
    });
});


$(document).ready(function(){
    $("#frmDeclareDangerBySum #cmbBus").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                bus:$(this).val()
            },
            success:function(res){
                $("#frmDeclareDangerBySum #cmbProvs option").remove();
                var table = jQuery.parseJSON(res);
                var div="";
                $("#frmDeclareDangerBySum #cmbProvs").append('<option value="-1">Сонгоно уу</option>');
                $.each(table, function(index, item){
                    $("#frmDeclareDangerBySum #cmbProvs").append('<option value="' + item.id + '"> ' + item.provName + ' </option>');
                });
            }
        });
    });
});


$(document).ready(function(){
    $("#frmDeclareDangerBySum #cmbProvs").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                provID:$(this).val()
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                console.log(table);
                var div="";
                $.each(table, function(index, item){
                    div = div + '<div class="col-md-4">';
                    div = div + '<div class="form-check">';
                    div = div + '<label class="form-check-label">';
                    div = div + '<input type="checkbox" name="sums[]" class="form-check-input sumduud" value="' + item.id + '">' + item.symName;
                    div = div + '</label></div></div>';
                });
                $("#frmDeclareDangerBySum #divSums").html('');
                $("#frmDeclareDangerBySum #divSums").html(div);
            }
        });
    });
});


//START Sumaar onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerSum").click(function(e){
        e.preventDefault();
        // alert($('#frmDeclareDangerBySum .sumduud').length);
        $("#frmDeclareDangerBySum #cmbBus").removeClass('border border-danger');
        $("#frmDeclareDangerBySum #cmbProvs").removeClass('border border-danger');
        $("#frmDeclareDangerBySum #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #dateDeclareDate").removeClass('border border-danger');
        if($("#frmDeclareDangerBySum #cmbBus").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerBySum #cmbBus").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #cmbProvs").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerBySum #cmbProvs").addClass('border border-danger');
            return;
        }
        var checkCount = 0;
        jsonObj = [];
        $("#frmDeclareDangerBySum .sumduud").each(function(){
            if($(this).prop('checked')){
                checkCount++;
                item = {}
            }
        });
        if(checkCount == 0){
            alertify.error("Та сум дүүргээ сонгоно уу!!!");
            return;
        }
        if($("#frmDeclareDangerBySum #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByBus #dateDeclareDate").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #txtPassword").val() == ""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerBySum #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerSum").hide();
        $("#frmDeclareDangerBySum #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina

        $.ajax({
            type: "post",
            url: $("#btnDeclareDangerSum").attr("post-url"),
            data:$("#frmDeclareDangerBySum").serialize(),
            success:function(res){
                $("#btnDeclareDangerSum").show();
                $("#frmDeclareDangerBySum #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerBySum')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerSum").show();
                $("#frmDeclareDangerBySum #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
    });
});
//END Sumaar onts baidal zarlah heseg


//START Aimgaar onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerProvince").click(function(e){
        e.preventDefault();
        // buh ulaan hureeg arilgaj baina
        $("#frmDeclareDangerByProvince #cmbBus").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #dateDeclareDate").removeClass('border border-danger');
        // buh ulaan hureeg arilgaj baina


        if($("#frmDeclareDangerByProvince #cmbBus").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerByProvince #cmbBus").addClass('border border-danger');
            return;
        }

        var checkCount = 0;
        $("#frmDeclareDangerByProvince .provs").each(function(){
            if($(this).prop('checked')){
                checkCount++;
            }
        });
        if(checkCount == 0){
            alertify.error("Та аймаг нийслэлээ сонгоно уу!!!");
            return;
        }
        if($("#frmDeclareDangerByProvince #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByProvince #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerByProvince #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByProvince #dateDeclareDate").addClass('border border-danger');
            return;
        }

        if($("#frmDeclareDangerByProvince #txtPassword").val() == ""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerByProvince #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerProvince").hide();
        $("#frmDeclareDangerByProvince #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina

        $.ajax({
            type: "post",
            url: $("#btnDeclareDangerProvince").attr("post-url"),
            data:$("#frmDeclareDangerByProvince").serialize(),
            success:function(res){
                $("#btnDeclareDangerProvince").show();
                $("#frmDeclareDangerByProvince #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerByProvince')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerProvince").show();
                $("#frmDeclareDangerByProvince #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
    });
});
//END Aimgaar onts baidal zarlah heseg



// Buseer onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerBus").click(function(e){
        e.preventDefault();
        // buh ulaan hureeg arilgaj baina
        $("#frmDeclareDangerByBus #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #dateDeclareDate").removeClass('border border-danger');
        // buh ulaan hureeg arilgaj baina

        // checkboxuud checklesen esehiig shalgaj baina
        var checkCount = 0;
        $("#frmDeclareDangerByBus .sectors").each(function(){
            if($(this).prop('checked')){
                checkCount++;
            }
        });
        if(checkCount == 0){
            alertify.error("Та онц байдал зарлах бүсээ сонгоно уу!!!");
            return;
        }
        // checkboxuud checklesen esehiig shalgaj bainas
        if($("#frmDeclareDangerByBus #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerByBus #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByBus #dateDeclareDate").addClass('border border-danger');
            return;
        }
        if($("#txtPassword").val()==""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerBus").hide();
        $("#frmDeclareDangerByBus #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina

        // onts baidal zarlah ajax
        $.ajax({
            type:"post",
            url:$("#btnDeclareDangerBus").attr("post-url"),
            data:$("#frmDeclareDangerByBus").serialize(),
            success:function(res){
                $("#btnDeclareDangerBus").show();
                $("#frmDeclareDangerByBus #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerByBus')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerBus").show();
                $("#frmDeclareDangerByBus #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
        // onts baidal zarlah ajax
    });
});
