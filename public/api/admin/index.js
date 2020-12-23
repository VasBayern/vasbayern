
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
    admin.common.api.get('dashboard/3').then(loadHomePageAdminCallback);
})


function loadHomePageAdminCallback(response) {
    console.log(response);
    const MONTHS = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
    const WEEKS = ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"];
    let label, labelxAxes, title;
    switch (response.sort) {
        case 1:
            labelxAxes = 'Tuần';
            label = 'Tuần';
            title = 'Doanh thu tuần';
            break;
        case 2:
            labelxAxes = 'Tháng';
            label = 'Tháng ' + new Date().getMonth();
            title = 'Doanh thu tháng ' + new Date().getMonth();
            break;
        case 3:
            labelxAxes = 'Năm';
            label = 'Năm ' + new Date().getFullYear();
            title = 'Doanh thu năm ' + new Date().getFullYear();
            break;
        default:
            break;
    }
    let type = response.sort == 0 ? 'giờ' : (response.sort == 1 ? '1 tuần' : (response.sort == 2 ? '1 tháng' : '1 năm'));
    $(".total-revenue").html(float2Vnd(response.revenue));
    $(".total-user").html(response.countUser);
    $(".total-product").html(response.countProductSold);
    $(".total-order").html(response.countOrder);
    $(".progress-revenue").html(calculateGrowthRate(response.revenue, response.revenueAgo, type));
    $(".progress-user").html(calculateGrowthRate(response.countUser, response.countUserAgo, type));
    $(".progress-product").html(calculateGrowthRate(response.countProductSold, response.countProductSoldAgo, type));
    $(".progress-order").html(calculateGrowthRate(response.countOrder, response.countOrderAgo, type));

    let chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgba(60,141,188,0.9)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };
    let i;
    let unitTime = [], data = [], dataAgo = [];
    let revenue = response.revenueByTime;
    let revenueAgo = response.revenueByTimeAgo;
    switch (response.sort) {
        case 0:
            break;
        case 1:
            unitTime = WEEKS;
            break;
        case 2:
            break;
        case 3:
            unitTime = MONTHS;
            break;
        default:
            break;

    }
    for (i = 0; i < revenue.length; i++) {
        data.push(revenue[i][1]);
    }
    for (i = 0; i < revenueAgo.length; i++) {
        dataAgo.push(revenueAgo[i][1]);
    }
    console.log(dataAgo);
    console.log(data);
    let config = {
        type: 'line',
        data: {
            labels: unitTime,
            datasets: [{
                label: label,
                borderColor: chartColors.blue,
                backgroundColor: chartColors.blue,
                data: data,
            },
            {
                label: label,
                backgroundColor: chartColors.grey,
                borderColor: chartColors.grey,
                data: dataAgo,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            },
            tooltips: {
                mode: 'label',
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: labelxAxes
                    },
                    ticks: {
                        min: 'Tháng 3'
                    }
                }],
                yAxes: [{
                    display: true,
                    beginAtZero: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Doanh thu (triệu đồng)"
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (value, index, values) {
                            return float2Vnd(value);
                        }
                    }
                }],
            }
        }
    };

    let ctx = document.getElementById("areaChart").getContext("2d");
    window.myLine = new Chart(ctx, config);

}

function float2Vnd(value) {
    return value.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
}

function calculateGrowthRate(value, valueAgo, type) {
    valueAgo = valueAgo > 0 ? valueAgo : 1;
    html = 'Tăng ' + Math.round(100 * value / valueAgo) + ' % trong ' + type;
    return html;
}
