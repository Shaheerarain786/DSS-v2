$(document).ready(function () {

    $("#branches").DataTable();

    let device_group_modal = $("#assignDeviceGroup");

    $('#assign-device-group-to-device').select2({
        dropdownParent: device_group_modal,
        placeholder: "Select Device Group"
    });

    $('#assign-device-to-device-group').select2({
        dropdownParent: device_group_modal,
        placeholder: "Select Multiple Devices"
    });

    /************ DataTables *****************/
    $("#branches").DataTable();
});
