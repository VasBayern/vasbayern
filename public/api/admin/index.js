$(document).ready(function () {
    $('[data-mask]').inputmask()
    $('#startDate').datetimepicker({
        format: 'L',
        language: "vi",
        autoclose: true,
    });
    $('#endDate').datetimepicker({
        format: 'L',
        language: "vi",
        autoclose: true,
    });
    admin.common.api.get('dashboard/2').then(loadHomePageAdminCallback);
})


function loadHomePageAdminCallback(response) {
    console.log(response);
    let type = response.sort == 1 ? '1 tuần' : (response.sort == 2 ? '1 tháng' : '1 năm');
    $(".total-revenue").html(float2Vnd(response.revenue));
    $(".total-user").html(response.countUser);
    $(".total-product").html(response.countProductSold);
    $(".total-order").html(response.countOrder);
    $(".progress-revenue").html('Tăng ' + calculateGrowthRate(response.revenue, response.revenueAgo) + ' % trong ' + type);
    $(".progress-user").html('Tăng ' + calculateGrowthRate(response.countUser, response.countUserAgo) + ' % trong ' + type);
    $(".progress-product").html('Tăng ' + calculateGrowthRate(response.countProductSold, response.countProductSoldAgo) + ' % trong ' + type);
    $(".progress-order").html('Tăng ' + calculateGrowthRate(response.countOrder, response.countOrderAgo) + ' % trong ' + type);

}
function float2Vnd(value) {
    return value.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
}

function calculateGrowthRate(value, valueAgo) {
    valueAgo = valueAgo > 0 ? valueAgo : 1;
    return Math.round(100 * value / valueAgo);
}