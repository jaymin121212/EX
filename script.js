$(document).ready(function () {

    // ✅ Load States
    $.post("fetch.php", {type: "state"}, function (data) {
        $("#state").append(data);
    });

    // ✅ State → City
    $("#state").change(function () {
        let state = $(this).val();
        $.post("fetch.php", {type: "city", state: state}, function (data) {
            $("#city").html(data);
            $("#pincode").html('<option value="">Select Pincode</option>');
        });
    });

    // ✅ City → Pincode
    $("#city").change(function () {
        let city = $(this).val();
        $.post("fetch.php", {type: "pincode", city: city}, function (data) {
            $("#pincode").html(data);
        });
    });

    // ✅ Pincode → Auto State & City
    $("#searchPincode").keyup(function () {
        let pin = $(this).val();
        if (pin.length == 6) {
            $.post("fetch.php", {type: "searchPin", pincode: pin}, function (data) {
                $("#result").html(data);
            });
        }
    });

});
